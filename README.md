# PHP_Rest_API_Sample
Thank you for the oportunity to move forward in the selection process!

In a real world situation I would have followed up with the person who made this request and clarified how the end product was going to be used.  I don't feel like the shape of the data being selected from [disease.sh/v3/covid-19/all](https://disease.sh/v3/covid-19/all) did not lend itself to a REST API, while the scope of all of [disease.sh](https://disease.sh) seemed too large to be reproducing here.  I decided that the most reasonable application of a REST API to this data was to allow the retrieval of all data by default, or specific data if indicated.  I chose not to use any REST frameworks for PHP, as I thought it would better demonstrate my coding style.

This was the first PHP that I've written.  It was an interesting excercise!

Written for PHP 8.2

In my solution I'm:
* Getting the HTTP request method and URL from the $_SERVER object, so I can reject requests to bad URLs or using methods that are not supported
* Downloading the data from the endpoint (https://disease.sh/v3/covid-19/all)
* Returning any errors that may happen
* Returning all data if the request was absent or for "all"
* Returning a specific piece of data if the request matched data returned from the endpoint

Possible improvements:
* Store the results in a database, cache, or file so they don't need to be fetched each time
* Store just the keys of the fetched data so bad requests can be filtered out before hitting the endpoint
* Change requests to be case insensitive

Build using:\
`docker compose build`\
Run using:\
`docker compose up`\
End with ctrl-c

While running the server can be reached on port 9000 of the machine where it is running, which is likely to be http://localhost:9000/
