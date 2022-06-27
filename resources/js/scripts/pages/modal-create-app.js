$(function () {
  ('use strict');

    var direction = 'ltr';
    if ($('html').data('textdirection') == 'rtl') {
        direction = 'rtl';
    }

  var modernVerticalWizard = document.querySelector('.create-app-wizard'),
    createAppModal = document.getElementById('createAppModal'),
    assetsPath = '../../../app-assets/',
    pipsRangevCPU = document.getElementById('pips-range-vcpu'),
    pipsRangevMemory = document.getElementById('pips-range-vmemory'),
    pipsRangevstorage = document.getElementById('pips-range-vstorage');

  if ($('body').attr('data-framework') === 'laravel') {
    assetsPath = $('body').attr('data-asset-path');
  }

  // --- create app  ----- //
  if (typeof modernVerticalWizard !== undefined && modernVerticalWizard !== null) {
    var modernVerticalStepper = new Stepper(modernVerticalWizard, {
      linear: false
    }),
      $form = $(createAppModal).find('form');
      $form.each(function () {
          var $this = $(this);
          $this.validate({
              rules: {
                  servername: {
                      required: true

                  },
                  operatingsystem: {
                      required: true
                  }
              }
          });
      });


      $(modernVerticalWizard)
          .find('.btn-next')
          .each(function () {
              $(this).on('click', function (e) {
                  var isValid = $(this).parent().siblings('form').valid();
                  if (isValid) {
                      modernVerticalStepper.next();
                  } else {
                      e.preventDefault();
                  }
              });
          });


    $(modernVerticalWizard)
      .find('.btn-prev')
      .on('click', function () {
        modernVerticalStepper.previous();
      });

    $(modernVerticalWizard)
      .find('.btn-review')
      .on('click', function () {
         // var vmos=document.getElementsByName('');

          var get_radio_environment = $("input[type='radio'].radioEnv:checked").val();
          var get_radio_tier = $("input[type='radio'].radioTier:checked").val();
          var get_radio_os = $("input[type='radio'].osradio:checked").val();
          var v_storage=pipsRangevstorage.noUiSlider.get();
          document.getElementById("hostname").value = $("input[name=servername]").val();
          document.getElementById("environement").value = get_radio_environment;
          document.getElementById("tier").value = get_radio_tier;
          document.getElementById("operating_system").value = $("input[name=operatingsystem]").val();
          document.getElementById("operating_system_option").value = get_radio_os;
          document.getElementById("v_cpu").value = pipsRangevCPU.noUiSlider.get();
          document.getElementById("v_memory").value = pipsRangevMemory.noUiSlider.get();
          document.getElementById("total_storage").value = pipsRangevstorage.noUiSlider.get();

          input_environment.innerText = get_radio_environment;
          input_tier.innerText = get_radio_tier;
          input_hostname.innerText = $("input[name=servername]").val();
          input_prefer_os.innerText = $("input[name=operatingsystem]").val();
          input_vcpu.innerText = pipsRangevCPU.noUiSlider.get();
          input_vmemory.innerText = pipsRangevMemory.noUiSlider.get();
          input_vstorage.innerText = pipsRangevstorage.noUiSlider.get();
      });

    $(modernVerticalWizard)
      .find('.btn-submit')
      .on('click', function () {
         // var vmos=document.getElementsByName('');

          document.forms["projectstoreserver"].submit();
       // alert('Submitted..!!');
      });


    // reset wizard on modal hide
    createAppModal.addEventListener('hide.bs.modal', function (event) {
      modernVerticalStepper.to(1);
    });
  }

    if (typeof pipsRangevCPU !== undefined && pipsRangevCPU !== null) {
        // Range
        noUiSlider.create(pipsRangevCPU, {
            start: 4,
            step: 1,
            range: {
                min: 2,
                max: 16
            },
            tooltips: true,
            direction: direction,
            pips: {
                mode: 'steps',
                stepped: true,
                density: 5
            }
        });
    }

    if (typeof pipsRangevMemory !== undefined && pipsRangevMemory !== null) {
        // Range
        noUiSlider.create(pipsRangevMemory, {
            start: 2,
            step: 2,
            range: {
                min: 2,
                max: 32
            },
            tooltips: true,
            direction: direction,
            pips: {
                mode: 'steps',
                stepped: false,
                density: 5
            }
        });
    }

    if (typeof pipsRangevstorage !== undefined && pipsRangevstorage !== null) {
        // Range
        noUiSlider.create(pipsRangevstorage, {
            start: 100,
            step: 50,
            range: {
                min: 100,
                max: 4000
            },
            tooltips: true
        });
    }


  // --- / create app ----- //
});
