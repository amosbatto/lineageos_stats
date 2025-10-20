lineageos_stats.php is a simple script to download LineageOS statistics
about the number of builds and installs from https://stats.lineageos.org
and display more information than is provided by the LineageOS web page.
  
By default the script shows the country list and the build list. 
The information in the lists is separated by tabs, so you can copy it 
from the terminal and paste it into your favorite spreadsheet 
application. It is much easier to read in a spreadsheet.
There is normally 1 build per device model, but some builds support 
multiple device models.
 
Getting the country list is fast, but getting the build list is
very slow because the script has to download all the builds for each 
country to construct the build list, and there are some less popular 
builds that it won't find because LineageOS only provides the top 250 
builds for each country. LineageOS doesn't provide a complete list of 
builds, but it does provide a total installs number, so any installs 
that aren't found are tallied at the end of the list under "Other 
builds". 

The status codes for the builds are: O=active official build, 
D=discontinued official build, U=unofficial build 
 
INSTALLATION: 
1. First install the command line interface for PHP. 
2. Then download this script and make sure that it is in a file named 
"lineageos_stats.php"
3. Download simple_html_dom.php from: 
https://sourceforge.net/projects/simplehtmldom
Decompress it and place it in a directory named "simple_html_dom" 
which is in the same directory as this script.
  
In a Debian/Ubuntu/Mint terminal this commands should work:
  sudo apt install php
  wget -O simplehtmldom.zip https://sourceforge.net/projects/simplehtmldom/files/latest/download
  unzip simplehtmldom.zip -d simple_html_dom
  
EXECUTION:
To run the script in a terminal: 
  php lineageos_stats.php
  
Depending on how you installed PHP, you may have to include the path to 
execute it. For example in Windows:
  C:\users\bob\php8.3\php.exe lineageos_stats.php 

Command line options:
-c , --country    Display the country list. 
                  Ex: php lineageos_stats.php -c
                  
                  Can specify an optional two letter country code or a
                  country name to just display for a single country.
                  Ex: php lineageos_stats.php -cUS
                  Ex: php lineageos_stats.php --country=BR
                  Ex: php lineageos_stats.php -c"United Arab Emirates"
                  
-b , --build      Display the build list.
                  Ex: php lineageos_stats.php -b

                  Can specify a buid codename to display info about that
                  build.
                  Ex: php lineageos_stats.php -b dipper
                  Ex: php lineageos_stats.php --build=dipper
                   
-i , --installs    Only show the number of installs. 
                  
-v , --verbose    Show information about what countries are being 
                  downloaded and what builds were found. Recommended for
                  progress on how script is progressing when getting the
                  build list.  

Author:  Amos Batto (amosbatto@yahoo.com, https://amosbbatto.wordpress.com)
License: public domain
Date:    2025-10-15 (version 0.1)
