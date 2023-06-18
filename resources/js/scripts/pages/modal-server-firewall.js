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


        switch(selectedValue) {
            case "ssh":
                document.getElementsByName($new_protocol)[0].value='tcp';
                document.getElementsByName($new_protocol)[0].setAttribute('disabled','true');
                document.getElementsByName($new_port_range)[0].value='22'
                document.getElementsByName($new_port_range)[0].setAttribute('readonly', true);
                break;
            case "https":
                document.getElementsByName($new_protocol)[0].value='tcp'
                document.getElementsByName($new_protocol)[0].setAttribute('disabled','true');
                document.getElementsByName($new_port_range)[0].value='443'
                document.getElementsByName($new_port_range)[0].setAttribute('readonly', true);
                break;
            case "http":
                document.getElementsByName($new_protocol)[0].value='tcp'
                document.getElementsByName($new_protocol)[0].setAttribute('disabled','true');
                document.getElementsByName($new_port_range)[0].value='80'
                document.getElementsByName($new_port_range)[0].setAttribute('readonly', true);
                break;
            case "mysql":
                document.getElementsByName($new_protocol)[0].value='tcp'
                document.getElementsByName($new_protocol)[0].setAttribute('disabled','true');
                document.getElementsByName($new_port_range)[0].value='3306'
                document.getElementsByName($new_port_range)[0].setAttribute('readonly', true);
                break;
            case "alltcp":
                document.getElementsByName($new_protocol)[0].value='tcp'
                document.getElementsByName($new_protocol)[0].setAttribute('disabled','true');
                document.getElementsByName($new_port_range)[0].value=''
                document.getElementsByName($new_port_range)[0].setAttribute('readonly', true);
                break;
            case "alludp":
                document.getElementsByName($new_protocol)[0].value='udp'
                document.getElementsByName($new_protocol)[0].setAttribute('disabled','true');
                document.getElementsByName($new_port_range)[0].value=''
                document.getElementsByName($new_port_range)[0].setAttribute('readonly', true);
                break;
            default:
                document.getElementsByName($new_port_range)[0].removeAttribute('readonly');
                document.getElementsByName($new_protocol)[0].removeAttribute('disabled');



        }



        // $.ajax({
        //     type: 'GET',
        //     url: "{{route('getservice')}}",
        //     data: {'value': selectedValue},
        //
        //     success: function (response) {
        //         console.log(response);
        //         var options = JSON.parse(response);
        //         var select = $field2;
        //         select.empty();
        //         select.append('<option value="">Select an option</option>');
        //         for (var i = 0; i < options.length; i++) {
        //             select.append('<option value="' + options[i].value + '">' + options[i].text + '</option>');
        //         }
        //         select.prop('disabled', false);
        //     }
        // });
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
