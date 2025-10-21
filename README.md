lineageos_stats.php is a command-line script to download LineageOS stats
about the number of builds and installs from https://stats.lineageos.org
It displays more information than is provided by the LineageOS web page,
which only displays builds by their code name and countries by their ISO
codes. This script can search for countries by their English names and 
for builds by their device model names. It tallies the total builds and 
installs by country, device manufacturer, processor family, release year
of devices, build status and LineageOS version number.   
  
By default the script shows the country list and the build list with 
statistics tables at the end. If information is known about a build 
(device model, manufacturer, processor family, device release year), 
that is displayed in the build list. There is normally 1 build per 
device model, but some builds support multiple device models.

The information in the lists is separated by tabs, so you can copy it 
from the terminal and paste it into your favorite spreadsheet 
application. It is much easier to read in a spreadsheet. 
 
Getting the country list is fast, but getting the build list is
very slow because the script has to download roughly 1500 web pages to
get all the builds for each country to construct the build list, and 
there are some less popular builds that it won't find because LineageOS 
only provides the top 250 builds for each country. LineageOS doesn't 
provide a complete list of builds, but it does provide a total installs 
number, so any installs that aren't found are tallied at the end of the 
list under "Other builds". 

The status codes for the builds are: O=active official build, 
D=discontinued official build, U=unofficial build 
 
INSTALLATION:   
1. Install the command line interface for PHP 7 or later. 
2. Download this script from https://github.com/amosbatto/lineageos_stats
   If the ZIP file was downloaded, then decompress it. 
  
In a Debian/Ubuntu/Mint terminal, these commands should work:  
  sudo apt install php
  wget -O lineageos_stats.zip https://github.com/amosbatto/lineageos_stats/archive/refs/heads/main.zip
  unzip lineageos_stats.zip -d lineageos_stats
  
EXECUTION:  
To run the script in a terminal:  
  php lineageos_stats.php
  
Depending on how you installed PHP, you may have to include the path to 
execute it. For example in Windows:  
  C:\users\bob\php8.3\php.exe lineageos_stats.php 

Command line options:  
  -c , --country   Display the country list.   
                   Ex: php lineageos_stats.php -c  
                   
  -cXX             Can specify an optional two letter country code or a
  --country=XX     country name to display stats for a single country.  
                   Ex: php lineageos_stats.php -cUS  
                   Ex: php lineageos_stats.php --country=BR  
                   Ex: php lineageos_stats.php -c"United Arab Emirates"  
                   
  -b , --build     Display the build list.  
                   Ex: php lineageos_stats.php -b  
                   
  -bCODENAME       Can specify a buid codename or a device model name to  
  --build=CODENAME display stats for a single build.  
                   Ex: php lineageos_stats.php -blavender  
                   Ex: php lineageos_stats.php --build=lavender  
                   Ex: php lineageos_stats.php -b"Xiaomi Redmi Note 7"  
                   Ex: php lineageos_stats.php --build="nOtE 7"  
                   The search is case insensitive and can find partial   
                   strings.
                   
  -i , --installs  Only show the number of installs and not other stats.     
                  
  -v , --verbose   Show information about what countries are being  
                   downloaded and what builds were found. Recommended 
                   for progress on how script is progressing when 
                   getting the build list.  

Author:  Amos Batto (amosbatto[AT]yahoo.com, https://amosbbatto.wordpress.com)  
License: MIT license (for the lineageos_stats script and the included 
         SimpleHtmlDom (https://sourceforge.net/projects/simplehtmldom  
Date:    2025-10-19 (version 0.1)
