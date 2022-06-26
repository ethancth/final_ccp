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
                  username: {
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
      .find('.btn-submit')
      .on('click', function () {
        alert('Submitted..!!');
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
