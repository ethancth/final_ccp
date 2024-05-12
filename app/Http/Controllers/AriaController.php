<?php

namespace App\Http\Controllers;

use App\Models\InfraSetting;
use App\Models\ProjectServer;
use http\Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;

class AriaController extends Controller
{
    //
    public $credentialobject,$infrasetting ;

    public $workflow_trigger_network, $server;

    public function getInitial(){
        $data=InfraSetting::where('company_id','=',Auth::User()->company_id)->first();

        $this->infrasetting=$data;
        $this->credentialobject=$data->VraName;
        $this->_url=$data->vra_server;
        $this->user_id=$data->vra_user_id;
        $this->user_credential=$data->vra_credential;
        $this->vra_domain=$data->vra_domain;
        $this->updated_at=$data->updated_at;
        $this->refresh_token=$data->refresh_token;
        $this->expired_date=$data->expired_date;
        $this->workflow_trigger_network=$data->network_workflow;
    }


    public function getDayToken($day,$type){
        $this->getInitial();


        if($type=='expired_date'){
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $this->expired_date);



        }else{
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $this->updated_at);
        }

        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', now());

        $diff_in_days = $to->diffInDays($from);


        if($this->infrasetting->refresh_token==''){
            return 1;
        }
        if($this->infrasetting->token==''){
            return 1;
        }
        if($diff_in_days>=$day)
        {
            return 1;
        }else{
            return 0;
        }

    }

    public function getToken(){
        if($this->getDayToken(90,'expired_date')){
            $this->updateRefreshToken();
        }

        if($this->getDayToken(1,'token')){
            $this->updateToken();
        }


    }

    public function trigger_provision($vmid){


        $this->trigger_provision_workflow($vmid);



    }

    public function get_system_type_by_network($param)
    {

        $param=strtolower($param);
        switch (true){
            case stripos($param,'web') !== false:
              $_return='WEB';
                break;
            case stripos($param,'app') !== false:
                $_return='APP';
                break;
            case stripos($param,'db') !== false:
                $_return='DBS';
                break;
            case stripos($param,'dmz') !== false:
                $_return='DMZ';
                break;
            default:
                $_return='APP';
        }

        return $_return;

    }

    public function show_json($vmid){

        $this->server=ProjectServer::where('id','=',$vmid)->first();

        $obj=[
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$this->infrasetting->token,
            ],
            'json' => [
                'deploymentId' => '',
                'deploymentName' => $this->server->project->title.'--'.$this->server->hostname.'-'.$this->server->id.'-'.date("dmY-hisa"),
                'description' => '',
                'plan' => 'false',
                'blueprintId' => $this->server->os->workflow_id,
                'content'=>'',
                'simulate'=>'false',
                'inputs'=>[
                    'vmid' => $vmid,
                    'project_code' =>  $this->server->project->id,
                    'cpu' => $this->server->v_cpu,
                    'memory' => ($this->server->v_memory),
                    "appname" => $this->server->project->title,
                    "display_hostname" => $this->server->hostname,
                    'projectid' => $vmid,
                    'itsr' => 1,
                    'projcode' => $this->server->project->title,
                    'image' => $this->server->os->name,
                    'entity' => $this->server->businessunitname->name,
                    'rccode' => $this->server->project->title,
                    'systype' => $this->get_system_type_by_network($this->server->network[0]->network_name),
                    'platform' => $this->server->tiername->name,
                    'environment' => $this->server->envname->name,
                    'network_pg' => $this->server->network[0]->network_name,
                    'network_ip' => $this->server->network[0]->network_ip,

                ]


            ]
        ];

        dump($obj);

    }

    public function trigger_provision_workflow($vmid){

        $this->server=ProjectServer::where('id','=',$vmid)->first();


        $this->getToken();
        $this->getInitial();
        $client = new Client(['verify' => false]);
        $url="https://".$this->_url."/blueprint/api/blueprint-requests";



        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.$this->infrasetting->token,
                ],
                'json' => [
                    'deploymentId' => '',
                    'deploymentName' => $this->server->project->title.'--'.$this->server->hostname.'-'.$this->server->id.'-'.date("dmY-hisa"),
                    'description' => '',
                    'plan' => 'false',
                    'blueprintId' => $this->server->os->workflow_id,
                    'content'=>'',
                    'simulate'=>'false',
                    'inputs'=>[
                        'vmid' => $vmid,
                        'project_code' =>  $this->server->project->id,
                        'cpu' => $this->server->v_cpu,
                        'memory' => ($this->server->v_memory),
                        "appname" => $this->server->project->title,
                        "display_hostname" => $this->server->hostname,
                        'projectid' => $vmid,
                        'itsr' => 1,
                        'projcode' => $this->server->project->title,
                        'image' => $this->server->os->name,
                        'entity' => $this->server->businessunitname->name,
                        'rccode' => $this->server->project->title,
                        'systype' => $this->get_system_type_by_network($this->server->network[0]->network_name),
                        'platform' => $this->server->tiername->name,
                        'environment' => $this->server->envname->name,
                        'network_pg' => $this->server->network[0]->network_name,
                        'network_ip' => $this->server->network[0]->network_ip,

                    ]


                ]
            ]);



            $body = json_decode($response->getBody()->getContents());


            $this->server->provision_status='In Progress';
            $this->server->provision_datetime=now();
            $this->server->save();

//            $_new_refresh_token=InfraSetting::where('company_id','=',Auth::User()->company_id)->first();
//            $_new_refresh_token->token=$body->token;
//            $_new_refresh_token->save();

        }catch (RequestException $e) {
            dd(json_decode($e->getResponse()->getBody()->getContents(), true));

        } catch(Exception $e){
            echo" Something Wrong : Other";
            dd($e);
            //other errors

        }
    }

    public function trigger_workflow(){

        $this->getInitial();
        $this->getToken();
        $client = new Client(['verify' => false]);
        $url="https://".$this->_url."/vco/api/workflows/".$this->workflow_trigger_network."/executions";


        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.$this->infrasetting->token,
                ],
                'body' => '{}'
            ]);

//
//            $response = $client->request('POST', 'https://sgbvraserp03.isddc.men.maxis.com.my/vco/api/workflows/ce2f6a77-390b-4ccd-8d6d-9c56cd1eb5d7/executions', [
//                'headers' => [
//                    'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImtpZCI6IjEyNjkwMzA5NjMxMTExMzUzMzk5In0.eyJpc3MiOiJodHRwOi8vaWRlbnRpdHktc2VydmljZS5wcmVsdWRlLnN2Yy5jbHVzdGVyLmxvY2FsOjgwMDAiLCJpYXQiOjE3MTQ0NDUyMzUsImV4cCI6MTcxNDQ3NDAzNSwianRpIjoiNGJmNDg4YjItNTZlMC00MjllLTkwOGEtOGFiMDIxZmVjZjExIiwiY29udGV4dCI6Ilt7XCJtdGRcIjpcInVybjpvYXNpczpuYW1lczp0YzpTQU1MOjIuMDphYzpjbGFzc2VzOlBhc3N3b3JkUHJvdGVjdGVkVHJhbnNwb3J0XCIsXCJpYXRcIjoxNzE0NDQ1MjM1LFwiaWRcIjoxNX1dIiwiYXpwIjoicHJlbHVkZS11c2VyLWhjak9qRUZvNWQiLCJzdWIiOiJTeXN0ZW0gRG9tYWluOmZjM2QyNTFiLTI0ODUtNGFmYi1iMjUyLTM0MTNiYWM1MDE5ZiIsImRvbWFpbiI6IlN5c3RlbSBEb21haW4iLCJ1c2VybmFtZSI6ImlkbWFkbWluIiwicGVybXMiOlsiY3NwOm9yZ19vd25lciIsImV4dGVybmFsLzRhMmUzOTNkLWRmNDktNDMxYy1iMmJlLTgxMGFlNWUyZTFjYy9Db2RlU3RyZWFtOmRldmVsb3BlciIsImV4dGVybmFsL2Y2NzNhMTFhLWU0YzQtNDM4YS1hNzJkLTc5YWU4YjgxOWZlYS9zYWx0c3RhY2s6YWRtaW4iLCJleHRlcm5hbC82MTExN2Y2Ni1mNjMyLTQ2ZjUtODM3Ny1hM2MyYjhkZGVhODgvb3JjaGVzdHJhdGlvbjpkZXNpZ25lciIsImV4dGVybmFsLzYxMTE3ZjY2LWY2MzItNDZmNS04Mzc3LWEzYzJiOGRkZWE4OC9vcmNoZXN0cmF0aW9uOnZpZXdlciIsImV4dGVybmFsLzRhMmUzOTNkLWRmNDktNDMxYy1iMmJlLTgxMGFlNWUyZTFjYy9Db2RlU3RyZWFtOmFkbWluaXN0cmF0b3IiLCJleHRlcm5hbC82MTExN2Y2Ni1mNjMyLTQ2ZjUtODM3Ny1hM2MyYjhkZGVhODgvb3JjaGVzdHJhdGlvbjphZG1pbiIsImV4dGVybmFsLzRjZTg2NmY3LWM4YjAtNDliZS04ZDljLWYxZDdlMmRhNWM3NS9jYXRhbG9nOmFkbWluIiwiZXh0ZXJuYWwvZDJjMGNmNTEtNTVlOS00M2QyLTg2MjgtYzAzZjliMGI1ODVlL21pZ3JhdGlvbjphZG1pbiIsImV4dGVybmFsL2QyYzBjZjUxLTU1ZTktNDNkMi04NjI4LWMwM2Y5YjBiNTg1ZS9hdXRvbWF0aW9uc2VydmljZTpjbG91ZF9hZG1pbiJdLCJjb250ZXh0X25hbWUiOiIwNjkwZjA5Ni0wODUzLTRlMGItOWQ2My04OWQwMzgwZTU0NzciLCJhY2N0IjoiaWRtYWRtaW4ifQ.VA94B1YIYWuP4MOcdDNmC_EAZMLITpVyWIT981npAYE_wutMWTqtJl-L9PqQUD7z5Z2Nznlba2rlD3jj4g7YvcrzRms8Fm1IWZZ1GSapxLOAb2PGoUN5T8LBWyfS5jTwU8nEYpEEMPzPNXx9JnaZenTNtfP5ulG4vn65CPMlrmLzCG0sgQszEe8F04xijJizoD93_OKhWFJIb85a8oaxhcUwYfajLY7ztEsTWZG9LOUytrUHIkYAdEMBTTG81a5ivUQRV9CCXOiNmfBR-vXeL455aFdYf4wkSO7fGy72uZpxIZdwkXz4MBQj4qEkvP2Ao6h2XqToIlcSLa9k24nh4A',
//                    'Content-Type' => 'application/json',
//                    'accept' => 'application/json',
//                ],
//                'body' => '{}'
//            ]);

            $body = json_decode($response->getBody()->getContents());

//            $_new_refresh_token=InfraSetting::where('company_id','=',Auth::User()->company_id)->first();
//            $_new_refresh_token->token=$body->token;
//            $_new_refresh_token->save();

        }catch (RequestException $e) {
            dd( json_decode($e->getResponse()->getBody()->getContents(), true));
            //dd($e->getResponse()->getBody()->getContents(),true);
           // dd( json_decode($e->getResponse()->getBody()->getContents(), true));
            // you can catch here 400 response errors and 500 response errors
            // see this https://stackoverflow.com/questions/25040436/guzzle-handle-400-bad-request/25040600
        } catch(Exception $e){
            echo" Something Wrong : Other";
            //other errors

        }


    }



    public function updateToken(){
        $client = new Client(['verify' => false]);
        $url="https://".$this->_url."/iaas/api/login";


        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'refreshToken' => $this->refresh_token,
                ]
            ]);
            $body = json_decode($response->getBody()->getContents());
            $_new_refresh_token=InfraSetting::where('company_id','=',Auth::User()->company_id)->first();
            $_new_refresh_token->token=$body->token;
            $_new_refresh_token->save();

        }catch (RequestException $e) {
            dd( json_decode($e->getResponse()->getBody()->getContents(), true));
            // you can catch here 400 response errors and 500 response errors
            // see this https://stackoverflow.com/questions/25040436/guzzle-handle-400-bad-request/25040600
        } catch(Exception $e){
            //other errors

        }
    }

    public function updateRefreshToken(){

        $this->getInitial();
        $client = new Client(['verify' => false]);
        $url="https://".$this->_url."/csp/gateway/am/api/login?=access_token";



        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'username' => $this->user_id,
                    'password' => $this->user_credential,
                    'domain' => $this->vra_domain,
                ]
            ]);
            $body = json_decode($response->getBody()->getContents());
            $_new_refresh_token=InfraSetting::where('company_id','=',Auth::User()->company_id)->first();
            $_new_refresh_token->refresh_token=$body->refresh_token;
            $_new_refresh_token->expired_date=now();
            $_new_refresh_token->save();

        }catch (RequestException $e) {
            dd( json_decode($e->getResponse()->getBody()->getContents(), true));
                // you can catch here 400 response errors and 500 response errors
                // see this https://stackoverflow.com/questions/25040436/guzzle-handle-400-bad-request/25040600
            } catch(Exception $e){
                //other errors

            }

    }




}
