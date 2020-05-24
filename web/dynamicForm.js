$(document).on('change','#adminbundle_schedule_classe',function () {
    let $field = $(this);
    let $form = $field.closest('form');
    let data = {};
    data[$field.attr('name')] = $field.val();
   $.post($form.attr('action'),data).then(function (data) {
       /*************** First Input ********************************/
       let $input = $(data).find('#adminbundle_schedule_seance1');

       $('#adminbundle_schedule_seance1').replaceWith($input);
       /*************** Second Input ********************************/
       let $input2 = $(data).find('#adminbundle_schedule_seance2');
       $('#adminbundle_schedule_seance2').replaceWith($input2);
       /*************** Third Input ********************************/
       let $input3 = $(data).find('#adminbundle_schedule_seance3');
       $('#adminbundle_schedule_seance3').replaceWith($input3);
       /*************** Last Input ********************************/
       let $input4 = $(data).find('#adminbundle_schedule_seance4');
       $('#adminbundle_schedule_seance4').replaceWith($input4);

   })
});