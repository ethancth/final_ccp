<!-- share SecurityGroup modal -->
<div class="modal fade" id="SecurityGroupMember" tabindex="-1" aria-labelledby="shareSecurityGroupTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-sm-5 mx-50 pb-4">
        <h1 class="text-center mb-1" id="shareSecurityGroupTitle">Security Group Member</h1>

        <label class="form-label fw-bolder font-size font-small-4 mb-50" for="addMemberSelect"> Add members </label>
          <select class="select2-data-ajax form-select" id="select2-ajax"></select>

        <p class="fw-bolder pt-50 mt-2">X Members</p>

        <!-- member's list  -->
        <ul class="list-group list-group-flush mb-2">
           @foreach($project->server as $servers)
          <li class="list-group-item d-flex align-items-start border-0 px-0">
            <div class="avatar me-75">
                @php
                $newpath='images/avatars/'.$servers->operating_system_option.'.png';
                @endphp
              <img src="{{asset($newpath)}}" alt="avatar" width="38" height="38" />
            </div>
            <div class="d-flex align-items-center justify-content-between w-100">
              <div class="me-1">
                <h5 class="mb-25">{{$servers->hostname}}</h5>
                <span>{{$servers->display_os}}</span>
              </div>

              <div class="dropdown">
                <button
                  class="btn btn-flat-secondary dropdown-toggle"
                  type="button"
                  id="member1"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <span class="d-none d-lg-inline-block">Action</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="member1">
                  <li><a class="dropdown-item" href="javascript:void(0)">Remove</a></li>
                </ul>
              </div>
            </div>
          </li>
            @endforeach
        </ul>
        <!--/ member's list  -->

        <!-- SecurityGroup link -->
      </div>
    </div>
  </div>
</div>
<!-- / share SecurityGroup modal -->
