Twitter API is used to get some information (twits, users etc.) from Twitter.
<br>
This application is for:<br>
    - getting last ten twits from the user that is searched.<br>
    - making a follow list by cookies.<br>

The application is created by the steps:<br>
    - Registering the the application to the twitter developers page.<br>
    - Get the bearer information by auth.php file.<br>
    - Use the api by gather.php with bearer information to store information to the twitter_cache file and extract information from json.<br>
    
Thanks to the people who wrote useful information about;<br>
    - Twitter Api ( https://christianvarga.com/how-to-get-public-feeds-using-twitters-v1-1-api/ )<br>
    - Storing cookies in array ( http://stackoverflow.com/questions/1959455/how-to-store-an-array-in-jquery-cookie#1960049 )<br>
    - Cookie javascript library ( https://github.com/js-cookie/js-cookie )<br>
    
And thanks to developers of Twitter and Twitter Boostrap.
