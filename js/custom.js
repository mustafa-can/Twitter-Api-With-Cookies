var cookieList = function(cookieName) {
var cookie = Cookies.get(cookieName);
var items = cookie ? cookie.split(/,/) : []; //prefer [] instead of new Array()
return {
    "add": function(val) {
        items.push(val);
        Cookies.set(cookieName, items.join(','));
    },
    "remove": function (val) {
        indx = items.indexOf(val);
        if(indx!=-1) items.splice(indx, 1);
        Cookies.set(cookieName, items.join(','));
    },
    "clear": function() {
        items = null;
        Cookies.remove(cookieName);
    },
    "items": function() {
        return items;
    }
  }
};
function search (username_, max_id_, isSearch) {
    if(isSearch == true) $('#loader2').show();
    else $('#loader').show();
    $.getJSON( "http://localhost/NoSocial/twitter_cache.php", {username: username_, max_id:max_id_}, function( data ) {
        var items = [];
        var created_at, id_str, text, user, user_id_str, user_name, user_screen_name, user_profile_image_url, twit;
        $.each(data, function(i) {
            created_at = data[i].created_at;
            id_str = data[i].id_str;
            text = data[i].text;
            user = data[i].user;
            user_id_str = user.id_str;
            user_name = user.name;
            user_screen_name = user.screen_name;
            user_profile_image_url = user.profile_image_url;
            twit = '<div class="row" style="border-radius: 5px; border: 1px solid #000; background: #FFFFFF;">' +
                        '<div class="col-xs-3 col-md-1">' +
                            '<img src="' + user_profile_image_url + '" alt="user_img" />' +
                        '</div>' +
                        '<div class="col-xs-8 col-xs-offset-1 col-md-8 col-xs-offset-0">' +
                            '<p style="font-weight: bold;">' + user_name + ' <small style="color:#9299A6; font-weight: normal;">@' + user_screen_name + ' ' + created_at +'</small></p>' +
                            '<p>' + text +'</p>' +
                        '</div>' +
                    '</div><br>';

            items.push( twit ); //tweet
            //folly
            $('#max-id').val(id_str);
            $('#user-name').val(user_screen_name);
        });
        if(isSearch == true)
            $('#content').html(	$( "<div/>", { "class": "container-fluid", html: items.join( "" )} )		);
        else
            $('#content').append(	$( "<div/>", { "class": "container-fluid", html: items.join( "" )} )		);

        $('#searchText').val('');
        //Same as Cooki.js follow/unfollow set
        var list = new cookieList(page);
        var items = list.items();
        var isFollowing = false;
        if(		jQuery.inArray(	$('#user-name').val(), items ) != -1	)	$('#follow').text('UnFollow');
        else $('#follow').text('Follow');

        $('#loader').hide();
        $('#loader2').hide();
        $('#older').show();
    });
}
$( document ).ready(function() {
    $.ajaxSetup ({
        cache: true
    });
    $('#loader').hide();
    $('#loader2').hide();
    $('#older').hide();

    //on refresh search for previous result
    if($('#user-name').val() != '') search($('#user-name').val(), null, true);

    //create follows list
    var list = new cookieList(page);
    var items = list.items();
    var follow_list = [];
    var isFollowing = false;
    for (var i = 0; i < items.length; i++) {
        follow_list.push('<li id="' + items[i] + '"><a href="#">' + items[i] + '</a></li>');
        if( items[i] === document.getElementById('user-name').value )
            isFollowing = true;
    }
    $( "#follows" ).html( follow_list );
    if(isFollowing == true) $('#follow').text('UnFollow'); else $('#follow').text('Follow');

    $('#searchText').autocomplete({
        source: items
    });

    //EVENTS
    $('#doSearch').click(function (e) {
        e.preventDefault();
        search($('#searchText').val(), null, true);
    });
    $('#searchText').keypress(function (e) {
      if (e.which == 13) {
          e.preventDefault();
          search($('#searchText').val(), null, true);
      }
    });

    $('#older').click(function (e) {
        e.preventDefault();
        search($('#user-name').val(), $('#max-id').val(), false);
    });

    $(function(){
        $('#follows a').each(function () {
            $(this).click(function(e){
                e.preventDefault();
                search($(this).text(), null, true);
            });
        });
    });

    $('#follow').click(function(e){
        e.preventDefault();
        var text = $('#follow').text();
        var value = document.getElementById('user-name').value;
        if (text == 'Follow') {
            list.add(value);
            $( "#follows" ).append( '<li id="' + value + '"><a href="#">' + value + '</a></li>' );
            $('#follow').text('UnFollow');
        }
        else if(text == 'UnFollow') {
            list.remove(value);
            $('#' + value).remove();
            $('#follow').text('Follow');
        }
    });

});
