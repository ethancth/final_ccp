/*=========================================================================================
    File Name: ext-component-drag-drop.js
    Description: drag & drop elements using dragula js
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  // Draggable Cards
  dragula([document.getElementById('card-drag-area')]);

  // Sortable Lists
  dragula([document.getElementById('basic-list-group')]);
  dragula([document.getElementById('multiple-list-group-a'), document.getElementById('multiple-list-group-b')]);

    $('body').on('click', '.demo', function () {

        //alert('btm function');

        var lis = document.getElementById("multiple-list-group-a").getElementsByTagName("li");
        var temp =[]
        for(let i =0;i<lis.length;i++){
            temp.push(lis[i].value);
            console.log(lis[i].value);
        }
        $('#form_id').val(temp);


        var lis1 = document.getElementById("multiple-list-group-b").getElementsByTagName("li");
        var temp1 =[]
        for(let i =0;i<lis1.length;i++){
            temp1.push(lis1[i].value);
            console.log(lis1[i].value);
        }
        $('#form_id1').val(temp1);


    });

  // Cloning
  dragula([document.getElementById('badge-list-1'), document.getElementById('badge-list-2')], {
    copy: true
  });

  // With Handles

  dragula([document.getElementById('handle-list-1'), document.getElementById('handle-list-2')], {
    moves: function (el, container, handle) {
      return handle.classList.contains('handle');
    }
  });
});
