$(function () {
    ('use strict');



    var select = $('.select2');


    select.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            // the following code is used to disable x-scrollbar when click in select input and
            // take 100% width in responsive also
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $this.parent()
        });
    });

    $("#modalDestination").select2({disabled:'readonly'});

    $('.port-form').repeater({
        initEmpty: false,
        show: function () {
            $(this).slideDown();
            // $('.hide-search').on('change', function () {
            //     console.log('You selected: ', this.value);
            // });
            // Feather Icons
            if (feather) {
                feather.replace({ width: 14, height: 14 });
            }
        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });

    $(".js-select2-port").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })

    $(document).on('change', '.hide-search', function() {
        var selectedValue = $(this).val();
        var $field2 = $(this).closest('div[data-repeater-item]').find('.hide-search');
        let str = $(this).attr("name")
        var $_protocol = str.slice(0, -5);
        var $new_protocol=$_protocol+'protocol]';
        var $new_port_range=$_protocol+'portrange]';



        const field = [ 'custom', 'alltcp', 'alludp'];

        if(field.includes(selectedValue)){
            switch(selectedValue) {
                case "alltcp":
                    document.getElementsByName($new_protocol)[0].value='tcp'
                    document.getElementsByName($new_protocol)[0].setAttribute('readonly', true);
                    document.getElementsByName($new_protocol)[0].setAttribute("style", "pointer-events: none;");

                    document.getElementsByName($new_port_range)[0].value=''
                    document.getElementsByName($new_port_range)[0].setAttribute('readonly', true);
                    break;
                case "alludp":
                    document.getElementsByName($new_protocol)[0].setAttribute("style", "pointer-events: none;");
                    document.getElementsByName($new_protocol)[0].value='udp'
                    document.getElementsByName($new_protocol)[0].setAttribute('readonly', true);
                    document.getElementsByName($new_port_range)[0].value=''
                    document.getElementsByName($new_port_range)[0].setAttribute('readonly', true);
                    break;
                default:
                    document.getElementsByName($new_port_range)[0].removeAttribute('readonly');
                    document.getElementsByName($new_protocol)[0].removeAttribute('readonly');
                    document.getElementsByName($new_protocol)[0].removeAttribute("style", "pointer-events: none;");



            }
        }else{
            $.ajax({
                type: 'GET',
                url: "{{route('getservice')}}",
                data: {'value': selectedValue},

                success: function (response) {
                    console.log(response);
                    let port ='';
                    document.getElementsByName($new_protocol)[0].value=response.protocol.toLowerCase();
                    document.getElementsByName($new_protocol)[0].setAttribute('readonly', true);
                    document.getElementsByName($new_protocol)[0].setAttribute("style", "pointer-events: none;");
                    if(response.port=='All ports')
                    {port ='';

                    }else{
                        port =response.port;
                    }
                    document.getElementsByName($new_port_range)[0].value=port;
                    document.getElementsByName($new_port_range)[0].setAttribute('readonly', true);
                }
            });
        }




    });

});
function showany(){
    document.getElementById('div-ip').style.display ='none';
    document.getElementById('div-sg').style.display ='none';
    document.getElementById('div-vm').style.display ='none';
}
function show(){
    document.getElementById('div-ip').style.display = 'block';

    document.getElementById('div-sg').style.display ='block';
    document.getElementById('div-vm').style.display ='block';
}
