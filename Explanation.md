# WP Rocket Crawler Plugin Explanation

## Problem statement

The website has been facing a downward trajectory of SEO Rankings, the web administrator has taken up a challenge to solve this problem. one on the ways the admin has identified is to find out the webpages linked to the website homepage and use those results to improve the rankings manually.


## Technical spec 

**Administrator backend**
 - Provide the admin with the ability to trigger the crawl process manually.
 - Access the saved results both from file system and database

**Crawling task**
 - Manual crawling triggerd by the admin on the backend by clicking the start button
 - Automated crawling done by the cron job every `hour`

**Data/Results**
 - Storing of the information in both the file system as html page for sitemap data as  `sitemap.html` and snapshot to `homepage.html`
 - Storing the found links on a table for later use

**View/Visualization**
 - Present the saved results of links to the admin in form of a list structure
 - Provide links to `sitemap.html` and `homepage.html` for viewing on new tab 


**Technical decisions**

1. Using wordpress 
   - its Free, opensource and easy to use as a CMS
   - Ability to extend the functionality in form of plugins and themes

2. Mysql
   - MySQL is the primary database used primarily by Wordpress therefore its easy to achieve maximum compatibility on our  implementations.

3. Third Party libs (Guzzle, Symfony)
   - These libraries offer advanced features of handling HTTP requests from Parsing, extracting data inside DOM,Crawling etc which is key to our app since we want accurate clean way of crawling and extracting specific information from the request.

3. Wordpress Core functionality
   - instead of writing from scratch things like Database and file system functionality , we leverage the existing  functions and classes provided by wordpress e.g `$wpdb` to perform database and file operations
    - other existing functionality is the scheduling function `wp_schedule_event` provided  by wordpress to help us run our crons

**How the code  works**

 The admin clicks the Start button the crawler process starts by making a HTTP request to the home using Client, 
 the response that is returned is parsed/crawled by the help of symfony Crawl class which in turn filters the result to only href tags which contains links.

 The links are then stored in the database by leveraging the wordpress `$wpdb` class to interact with the database.
 The response is also stored in the File system as html pages for the snapshot `homepage.html`  and the links as `sitemap.html` page  is generated from the list of links returned we also leverage the wordpress file class to interact with file system.



**Solution Goal**
The needs of our web administrator were to be able to crawl,store and view then take action based on the results.this whole process has automated the entire problem with one click of a button and also the automated crawling incase of any changes on the homepage, this is a simple and a dynamic approach to the problem which we can apply to other pages if need be.


**Problem approach**
my approach was to gather the input requirements to help understand admin expectation, use the input to design the system by  breaking it down into several parts namely Crawling,Storing and viewing, decide on the technical tools, the build the solution using our guideline.

**Thoughts on the solution**
Our simplicity of our solution has enabled the admin to perfom the tedious task faster with better results, and also the solution has left a window of scalability in future incase of more features.

**Why i choosed this Direction**
 - Deadline : ability to deliver the application on time
 - Goal: provide admin with a fast,easy to use app that doesnt clutter or complicate anything it does only one thing and it does it better


**Why i thought this direction is a better**
 - the application  was meant to be either a  php stand aline app or a wordpress plugin and the problem to be solved touched SEO, this area Wordpress works best therefore building a simple plugin to take advantage of wordpress core functionality and extend it makes a candidate to offer a simple lightweight solution that we can build in no time.
