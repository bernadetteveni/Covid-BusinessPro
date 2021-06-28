# ENSE 374 Project
## Covid BusinessPro Web Application
[Link to Website](http://www2.cs.uregina.ca/~veninatb/Signup.php),
[Covid BusinessPro Advertisement](https://youtu.be/rZd710qD6V8) (Activity #5), 
 [VLOG 1](https://www.youtube.com/watch?v=-A4Cb1X_mj0&feature=youtu.be)
, [VLOG 2](https://youtu.be/RHELajsj6EE)
, [VLOG 3](https://youtu.be/NnM0xuFU-Bk)

## Table of Contents
* [Members](#members)
* [Installation](#installation)
* [Proposed Project](#proposed)
* [Project Background](#project)
* [Business Need/Opportunity](#business)

## Members
Bernadette Veninata,
Alish Kadiwal,
Zhuo Chen,
Abraham Mugerwa

## Installation
### Recomended Requirements:
  * Intel Core 2 Duo processor 2.4 GHz or better
  * If transcoding for multiple devices, a faster CPU may be required
  * At least 2GB RAM
  * Windows: Vista or later
  * OS X: MacOS 10.13 or later
  * Ubuntu, Debian, Fedora, CentOS or SuSE Linux  
Connection via Visual Studio code:
  * Install 'Remote - SSH' and 'Remote - SSH: Editing Configuration Files' from the extention into your packages and follow following steps:
    1. Press F1 and run the Remote-SSH: Open SSH Host... command.
    1. Enter your user and host/IP in the following format in the input box that appears and press enter: user@domain@host-or-ip
    1. If prompted, enter your password (but we suggest setting up key based authentication).
    1. After you are connected, use File > Open Folder to open a folder on the host.
  * Click on Open Folders and type '/var/www/html'
  * After successful connection, type in basic commands to make connection like:
```
git init
git config --global user.name "your_username"
git config --global user.email "your_email_address@example.com"

```
We have already installed php-mysql on our server and to access our database we used following command line and prompt in our password:
```
mysql -u ense374 -p
```
## Proposed Project
The Covid BusinessPro web application is designed to collect information to aid with the response to the COVID-19 pandemic. Our app aims to help the people of Regina feel safe within their business organizations, and to aid local businesses with reopening operations during this time.  Information will be gathered by user's responses to a series of well-designed questions that assist with decision making such as isolation efforts and contact tracing. The app provides graphical representation of the data, keeping track of trends. Users of the app can expect to:
* Keep track of symptoms via a checklist/database of symptoms
* Keep a log of locations you have visited for contact tracing purposes
* Be able to track the trend of user symptoms.   

## Project Background
In the midst of a global pandemic, COVID-19 is threatening Regina businesses and employees alike. The symptoms of COVID-19 are fever, cough, fatigue, shortness of breath and even death. The usual onset duration is 2-14 days from infection. Research shows that working areas are highly susceptible to becoming infected with the virus. Our group believes that every attempt should be made to stop the spread of COVID‐19 at the immediate sign of symptoms. Governmental apps currently being used in the province to track COVID‐19 only allow users who have already tested positive to log their cases, at this point they have already been exposed to multiple people. Our group also firmly believes that users should not be required to allow access to their phone’s GPS or bluetooth just to safeguard themselves during this time.  To keep people in good health, we will use designated databases geared for business organizations.  We will have login and signup pages which will be encrypted, and personal data will not be sold or distributed. Our app will follow PIPEDA and HIPAA guidelines. We will store user data into our database and reflect that through a graphical representation of data.
* https://www.canada.ca/en/public-health/services/diseases/2019-novel-coronavirus-infection/prevent-control-covid-19-long-term-care-homes.html
* https://www.cdc.gov/coronavirus/2019-ncov/hcp/duration-isolation.html
* https://www.canada.ca/en/public-health/services/diseases/coronavirus-disease-covid-19/covid-alert.html?&utm_campaign=hc-sc-covidalertapp&utm_medium=sem&utm_source=ggl&utm_content=ad-text-en&utm_term=covid%20alert%20app&adv=2021-0024&id_campaign=11144748448&id_source=112252229027&id_content=465842087974


## Business Need/Opportunity
Our app is marketed towards Regina businesses. Currently, many businesses within Regina have had to temporarily close when exposed with an active case of COVID‐19. Within a large business framework, this could become tedious and costly.  Rather than clean entire premises and conduct a contact tracing investigation within the organization after a positive COVID‐19 test result by an employee, our app provides an immediate alert to the employer, triggered when an employee has 3 to 4 (alert level 1) or 5+ (alert level 2) corresponding COVID-19 symptoms. Our app has a contact tracing component, which supplies an immediate chain of contacts within the business, reflecting who employees were in contact with, and in which areas of the building, or departments.  Generated data helps to optimize the business response to take precautionary measures such as mandating the employee stay home and receive testing, and for the business to initiate a “deep cleaning” of related areas. Our app provides real time data for businesses to track the trend of symptoms.





