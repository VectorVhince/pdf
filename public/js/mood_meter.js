$(document).ready(function(){

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  })
  var urlMood = $('#moodForm').data('url');
  var token = $('#moodForm').data('token')

  $('.moodBtn').on('click',function(){
    var moodVal = $(this).val();
    // console.log(urlMood);
    $.ajax({
          type: "POST",
          url: urlMood,
          dataType: 'json',
          data: { mood: moodVal, _token: token }
      }).done(function(){
        $('#moodForm').hide();
        $('#moodSuccess').show();
        $('#moodMessage').text(moodVal);
      });
  });
});
