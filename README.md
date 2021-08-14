# Search Engines Web Scraping
a simple class-based search engine web scraper contains Google, Bing and Yahoo
## How are links extracted?
As you know, search engines use the get method to get input from user like "https://www.google.com/search?q={{keyword}}" for google.
After finding the desired address for the relevant search engine, we parse the requested page using the DOM interface to reach the url and the title of the links.
the PHP asset that i've been used used for DOM parsing: [simplehtmldom](https://github.com/simplehtmldom/simplehtmldom).
## Comparison Class:
This class takes an array containing the links extracted from the search engines at its constructor input and compares the search engine links with each other in a binary manner, and if it finds a similar link, it is ranked in the same array.
For example, after doing this processing, we can find out what rankings are extracted in Google on Bing.
## Suggestions Class:
This class is responsible for ranking and scoring all the extracted links, based on the rankings of the links in the search engines and the relevant search engine market share based on the statistics of the [webfx website](https://www.webfx.com/blog/seo/2019-search-market-share/).
### Simple test:
If you run the index.php file
You can see the suggested links along with their scores and links extracted from the three search engines Google, Bing and Yahoo.
###### Note:
With IP inside Iran, you can extract Bing links!
