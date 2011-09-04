$(document).ready(function(){
  $("a.showtweets").click(function(event){
    var url = "http://search.twitter.com/search.json?q=" + encodeURIComponent(show.hashtag) + "&result_type=recent";
    $.ajax({
      url: url,
      type: "GET",
      dataType: "jsonp",
      success: function(data) {
        var items = [];

        $.each(data['results'], function(key, val) {
          items.push('<li>' + val['text'] + '</li>');
        });

        $('#tweet-list').remove();

        $('<ul/>', {
          id: 'tweet-list',
          html: items.join('')
        }).appendTo('#tweets');
      }
    });

    event.preventDefault();
  });
});
