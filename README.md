`lineageos_stats.php` is a command-line script to download LineageOS stats
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

Getting the country list is fast, but getting the build list is
very slow because the script has to download roughly 1500 web pages to
get all the builds for each country to construct the build list, and 
there are some less popular builds that it won't find because LineageOS 
only provides the top 250 builds for each country. LineageOS doesn't 
provide a complete list of builds, but it does provide a total installs 
number, so any installs that aren't found are tallied at the end of the 
list under "Unlisted". 

The status codes for the builds are:  
**O** = active official build,  
**D** = discontinued official build,  
**U** = unofficial build  
Note that many of the installs labeled as "O" are for versions that are
now discontinued, since they are no longer getting security updates.  
 
**Installation:**   
1. Install the command line interface for PHP 7 or later. ´
2. Install the php-mbstring and yaml extensions.
3. Download this script from https://github.com/amosbatto/lineageos_stats
   If the ZIP file was downloaded, then decompress it. 
  
In a Debian/Ubuntu/Mint terminal, these commands should work: 
```
sudo apt install php php-mbstring php-yaml
wget -O lineageos_stats.zip https://github.com/amosbatto/lineageos_stats/archive/refs/heads/main.zip
unzip lineageos_stats.zip -d lineageos_stats
```
  
**Execution:**  
To run the script in a terminal:  
`php lineageos_stats.php`
  
Depending on how you installed PHP, you may have to include the path to 
execute it. For example in Windows:  
`C:\users\bob\php8.3\php.exe lineageos_stats.php` 

**Command line options:**  
```
-c , --country     Display the country list.   
                   Ex: php lineageos_stats.php -c  
                  
-cXX               Can specify an optional two letter country code or a
--country=XX       country name to display stats for a single country.
                   Ex: php lineageos_stats.php -cUS  
                   Ex: php lineageos_stats.php --country=BR  
                   Ex: php lineageos_stats.php -c"United Arab Emirates"
                  
-b , --build       Display the build list.  
                   Ex: php lineageos_stats.php -b  
  
-bCODENAME         Can specify a build codename or a device model name 
--build=CODENAME   to display stats for a single build.  
                   Ex: php lineageos_stats.php -blavender  
                   Ex: php lineageos_stats.php --build=lavender  
                   Ex: php lineageos_stats.php -b"Xiaomi Redmi Note 7"
                   Ex: php lineageos_stats.php --build="nOtE 7"  
                   The search is case insensitive and can find partial 
                   strings.
                   
-sSEP              The field separator for tables, which can bezZ4 any 
--separator=SEP    string and is " | " by default. Set a different 
                   separator to not have info truncated. It is 
                   recommended to set to "\t" (tab) if copying into a 
                   spreadsheet and to ',' (comma) or ';' (semicolon) if
                   copying into a CSV (comma separated value) file. 
                   Ex: php lineageos_stats.php -s"\t"                 
                   Ex: php lineageos_stats.php -separator="; "      
                  
-f                 Find new builds by downloading all the countries and
--find-builds      looking for new builds.                       
                  
-u                 Update the list of devices in the buildsList.txt
--update-devices   file from the LineageOS wiki.   
                                                                      
-p                 Update the population of the countries to the current
--update-pop       year.      

-oVERSION          Oldest official LineageOS version that is still   
--official=VERSION getting security updates, which is currently 20. This
                   determines when status changes to 'D' (discontinued).
                   Ex: php lineageos_stats.php -o21
                   Ex: php lineageos_stats.php --official=21
                  
-v , --verbose     Show information about what countries are being  
                   downloaded and what builds were found. Recommended 
                   for progress on how script is progressing when 
                   getting the build list.  
```

**Author:**  Amos Batto (amosbatto[AT]yahoo.com, https://amosbbatto.wordpress.com)  
**License:** MIT license (for the lineageos_stats script and the included 
         SimpleHtmlDom https://sourceforge.net/projects/simplehtmldom)  
**Last update:**    2025-10-28 (version 0.4)  

----------------

For people who don't what to install and run this script on their own
computers, here is the output of the script:

```
$ php lineageos_stats.php  

Countries by number of LineageOS installs
---------------------------------------------------------------------------------------------
| Rank |   CC    |        Country         | Installs | % Installs | Installs/M | Pop. (000) |
---------------------------------------------------------------------------------------------
| 1    | BR      | Brazil                 |  1891190 |     44.17% |       8887 |  212812.41 |
| 2    | CN      | China                  |  1300615 |     30.38% |        918 | 1416096.09 |
| 3    | US      | United States          |   306128 |      7.15% |        882 |  347275.81 |
| 4    | Unknown |                        |   217125 |      5.07% |            |            |
| 5    | VN      | Viet Nam               |    83771 |      1.96% |        825 |  101598.53 |
| 6    | ID      | Indonesia              |    43858 |      1.02% |        153 |  285721.24 |
| 7    | DE      | Germany                |    43003 |      1.00% |        511 |   84075.08 |
| 8    | UA      | Ukraine                |    35241 |      0.82% |        904 |   38980.38 |
| 9    | RU      | Russian Federation     |    33197 |      0.78% |        231 |  143997.39 |
| 10   | IN      | India                  |    25748 |      0.60% |         18 | 1463865.53 |
| 11   | KR      | South Korea            |    24573 |      0.57% |        476 |   51667.03 |
| 12   | FR      | France                 |    19541 |      0.46% |        293 |   66650.80 |
| 13   | GB      | United Kingdom         |    14356 |      0.34% |        206 |   69551.33 |
| 14   | ES      | Spain                  |    12819 |      0.30% |        268 |   47889.96 |
| 15   | IT      | Italy                  |    12447 |      0.29% |        210 |   59146.26 |
| 16   | TR      | Turkey                 |    11128 |      0.26% |        127 |   87685.43 |
| 17   | TH      | Thailand               |    10968 |      0.26% |        153 |   71619.86 |
| 18   | PL      | Poland                 |    10763 |      0.25% |        282 |   38140.91 |
| 19   | EG      | Egypt                  |    10292 |      0.24% |         87 |  118366.00 |
| 20   | KG      | Kyrgyzstan             |     8868 |      0.21% |       1216 |    7295.03 |
| 21   | KH      | Cambodia               |     8510 |      0.20% |        477 |   17847.98 |
| 22   | JP      | Japan                  |     8145 |      0.19% |         66 |  123103.48 |
| 23   | MX      | Mexico                 |     7616 |      0.18% |         58 |  131946.90 |
| 24   | NL      | Netherlands            |     6917 |      0.16% |        377 |   18346.82 |
| 25   | CA      | Canada                 |     6732 |      0.16% |        168 |   40126.72 |
| 26   | BD      | Bangladesh             |     4736 |      0.11% |         27 |  175686.90 |
| 27   | IQ      | Iraq                   |     4409 |      0.10% |         94 |   47020.77 |
| 28   | IR      | Iran                   |     4397 |      0.10% |         48 |   92417.68 |
| 29   | AR      | Argentina              |     4251 |      0.10% |         93 |   45851.38 |
| 30   | PK      | Pakistan               |     3830 |      0.09% |         15 |  255219.55 |
| 31   | TW      | Taiwan                 |     3674 |      0.09% |        159 |   23112.79 |
| 32   | PH      | Philippines            |     3640 |      0.09% |         31 |  116786.96 |
| 33   | CO      | Colombia               |     3214 |      0.08% |         60 |   53425.64 |
| 34   | MA      | Morocco                |     3161 |      0.07% |         82 |   38430.77 |
| 35   | AU      | Australia              |     3077 |      0.07% |        114 |   26974.03 |
| 36   | MY      | Malaysia               |     2949 |      0.07% |         82 |   35977.84 |
| 37   | DZ      | Algeria                |     2790 |      0.07% |         59 |   47435.31 |
| 38   | CZ      | Czech Republic         |     2766 |      0.06% |        261 |   10609.24 |
| 39   | RO      | Romania                |     2733 |      0.06% |        145 |   18908.65 |
| 40   | AT      | Austria                |     2727 |      0.06% |        299 |    9113.57 |
| 41   | PT      | Portugal               |     2648 |      0.06% |        254 |   10411.83 |
| 42   | CH      | Switzerland            |     2375 |      0.06% |        265 |    8967.41 |
| 43   | LA      | Laos                   |     2373 |      0.06% |        301 |    7873.05 |
| 44   | SE      | Sweden                 |     2325 |      0.05% |        218 |   10656.63 |
| 45   | SY      | Syrian Arab Republic   |     2255 |      0.05% |         88 |   25620.43 |
| 46   | HU      | Hungary                |     2250 |      0.05% |        234 |    9632.29 |
| 47   | BY      | Belarus                |     2194 |      0.05% |        244 |    8997.60 |
| 48   | NG      | Nigeria                |     2043 |      0.05% |          9 |  237527.78 |
| 49   | PE      | Peru                   |     1926 |      0.04% |         56 |   34576.67 |
| 50   | BE      | Belgium                |     1871 |      0.04% |        159 |   11758.60 |
| 51   | CL      | Chile                  |     1821 |      0.04% |         92 |   19859.92 |
| 52   | GR      | Greece                 |     1785 |      0.04% |        180 |    9938.84 |
| 53   | FI      | Finland                |     1767 |      0.04% |        314 |    5623.33 |
| 54   | AE      | United Arab Emirates   |     1721 |      0.04% |        152 |   11346.00 |
| 55   | HK      | Hong Kong              |     1709 |      0.04% |        231 |    7396.08 |
| 56   | SA      | Saudi Arabia           |     1462 |      0.03% |         42 |   34566.33 |
| 57   | IL      | Israel                 |     1387 |      0.03% |        146 |    9517.18 |
| 58   | VE      | Venezuela              |     1332 |      0.03% |         47 |   28516.90 |
| 59   | GH      | Ghana                  |     1320 |      0.03% |         38 |   35064.27 |
| 60   | KZ      | Kazakhstan             |     1232 |      0.03% |         59 |   20843.75 |
| 61   | SK      | Slovakia               |     1226 |      0.03% |        224 |    5474.88 |
| 62   | RS      | Serbia                 |     1212 |      0.03% |        181 |    6689.04 |
| 63   | MM      | Myanmar                |     1210 |      0.03% |         22 |   54850.65 |
| 64   | BG      | Bulgaria               |     1176 |      0.03% |        175 |    6714.56 |
| 65   | ZA      | South Africa           |     1173 |      0.03% |         18 |   64747.32 |
| 66   | OM      | Oman                   |     1151 |      0.03% |        209 |    5494.69 |
| 67   | EC      | Ecuador                |     1070 |      0.02% |         59 |   18289.90 |
| 68   | MG      | Madagascar             |     1001 |      0.02% |         31 |   32740.68 |
| 69   | BO      | Bolivia                |      978 |      0.02% |         78 |   12581.84 |
| 70   | NP      | Nepal                  |      970 |      0.02% |         33 |   29618.12 |
| 71   | LK      | Sri Lanka              |      969 |      0.02% |         42 |   23229.47 |
| 72   | KE      | Kenya                  |      943 |      0.02% |         16 |   57532.49 |
| 73   | NZ      | New Zealand            |      942 |      0.02% |        179 |    5251.90 |
| 74   | CM      | Cameroon               |      907 |      0.02% |         30 |   29879.34 |
| 75   | DK      | Denmark                |      888 |      0.02% |        148 |    6002.51 |
| 76   | SV      | El Salvador            |      884 |      0.02% |        139 |    6365.50 |
| 77   | LT      | Lithuania              |      873 |      0.02% |        308 |    2830.14 |
| 78   | NO      | Norway                 |      872 |      0.02% |        155 |    5623.07 |
| 79   | UZ      | Uzbekistan             |      761 |      0.02% |         21 |   37053.43 |
| 80   | SG      | Singapore              |      755 |      0.02% |        129 |    5870.75 |
| 81   | JO      | Jordan                 |      727 |      0.02% |         63 |   11520.68 |
| 82   | AZ      | Azerbaijan             |      718 |      0.02% |         69 |   10397.71 |
| 83   | IE      | Ireland                |      679 |      0.02% |        128 |    5308.04 |
| 84   | HR      | Croatia                |      642 |      0.01% |        167 |    3848.16 |
| 84   | BA      | Bosnia and Herzegovina |      642 |      0.01% |        204 |    3140.10 |
| 86   | MD      | Moldova                |      558 |      0.01% |        186 |    2996.11 |
| 87   | DO      | Dominican Republic     |      551 |      0.01% |         48 |   11520.49 |
| 88   | ET      | Ethiopia               |      493 |      0.01% |          4 |  135472.05 |
| 89   | EE      | Estonia                |      469 |      0.01% |        349 |    1344.23 |
| 90   | ZM      | Zambia                 |      462 |      0.01% |         21 |   21913.87 |
| 90   | SI      | Slovenia               |      462 |      0.01% |        218 |    2117.07 |
| 92   | TN      | Tunisia                |      453 |      0.01% |         37 |   12348.57 |
| 93   | TG      | Togo                   |      419 |     0.010% |         43 |    9721.61 |
| 94   | GE      | Georgia                |      398 |     0.009% |        105 |    3806.67 |
| 95   | ML      | Mali                   |      392 |     0.009% |         16 |   25198.82 |
| 96   | LV      | Latvia                 |      391 |     0.009% |        211 |    1853.56 |
| 97   | PY      | Paraguay               |      365 |     0.009% |         52 |    7013.08 |
| 98   | UG      | Uganda                 |      364 |     0.009% |          7 |   51384.89 |
| 99   | UY      | Uruguay                |      330 |     0.008% |         97 |    3384.69 |
| 100  | YE      | Yemen                  |      329 |     0.008% |          8 |   41773.88 |
| 100  | CI      | Côte d'Ivoire          |      329 |     0.008% |         10 |   32711.55 |
| 102  | CU      | Cuba                   |      325 |     0.008% |         30 |   10937.20 |
| 103  | SN      | Senegal                |      312 |     0.007% |         16 |   18931.97 |
| 104  | CR      | Costa Rica             |      297 |     0.007% |         58 |    5152.95 |
| 105  | GT      | Guatemala              |      273 |     0.006% |         15 |   18687.88 |
| 106  | AM      | Armenia                |      266 |     0.006% |         90 |    2952.37 |
| 107  | AO      | Angola                 |      242 |     0.006% |          6 |   39040.04 |
| 108  | BJ      | Benin                  |      228 |     0.005% |         15 |   14814.46 |
| 109  | CD      | Congo, Democratic Rep… |      222 |     0.005% |          2 |  112832.47 |
| 110  | AL      | Albania                |      220 |     0.005% |         79 |    2771.51 |
| 111  | HN      | Honduras               |      195 |     0.005% |         18 |   11005.85 |
| 112  | JM      | Jamaica                |      181 |     0.004% |         64 |    2837.08 |
| 113  | TZ      | Tanzania               |      179 |     0.004% |          3 |   70546.00 |
| 114  | AF      | Afghanistan            |      177 |     0.004% |          4 |   43844.11 |
| 115  | PA      | Panama                 |      168 |     0.004% |         37 |    4571.19 |
| 116  | MK      | Macedonia              |      167 |     0.004% |         92 |    1813.79 |
| 117  | LB      | Lebanon                |      165 |     0.004% |         28 |    5849.42 |
| 118  | QA      | Qatar                  |      161 |     0.004% |         52 |    3115.89 |
| 119  | CY      | Cyprus                 |      156 |     0.004% |        114 |    1370.75 |
| 120  | NI      | Nicaragua              |      153 |     0.004% |         22 |    7007.50 |
| 121  | BH      | Bahrain                |      149 |     0.003% |         91 |    1643.33 |
| 122  | RE      | Réunion                |      146 |     0.003% |        165 |     882.41 |
| 123  | LY      | Libya                  |      144 |     0.003% |         19 |    7458.56 |
| 124  | ZW      | Zimbabwe               |      140 |     0.003% |          8 |   16950.80 |
| 124  | KW      | Kuwait                 |      140 |     0.003% |         28 |    5026.08 |
| 126  | LU      | Luxembourg             |      135 |     0.003% |        198 |     680.45 |
| 127  | TJ      | Tajikistan             |      127 |     0.003% |         12 |   10786.73 |
| 128  | MZ      | Mozambique             |      126 |     0.003% |          4 |   35631.65 |
| 129  | GM      | Gambia                 |      116 |     0.003% |         41 |    2822.09 |
| 130  | MW      | Malawi                 |      109 |     0.003% |          5 |   22216.12 |
| 131  | TT      | Trinidad and Tobago    |       89 |     0.002% |         59 |    1511.16 |
| 132  | IS      | Iceland                |       81 |     0.002% |        203 |     398.27 |
| 133  | MT      | Malta                  |       79 |     0.002% |        145 |     545.41 |
| 134  | BF      | Burkina Faso           |       78 |     0.002% |          3 |   24074.58 |
| 135  | SL      | Sierra Leone           |       77 |     0.002% |          9 |    8819.79 |
| 136  | ME      | Montenegro             |       76 |     0.002% |        120 |     632.73 |
| 137  | MN      | Mongolia               |       74 |     0.002% |         21 |    3517.10 |
| 138  | MV      | Maldives               |       69 |     0.002% |        130 |     529.68 |
| 139  | PG      | Papua New Guinea       |       68 |     0.002% |          6 |   10762.82 |
| 140  | MU      | Mauritius              |       64 |     0.001% |         50 |    1268.28 |
| 141  | RW      | Rwanda                 |       62 |     0.001% |          4 |   14569.34 |
| 141  | CG      | Congo                  |       62 |     0.001% |         10 |    6484.44 |
| 143  | SD      | Sudan                  |       60 |     0.001% |          1 |   51662.15 |
| 144  | GN      | Guinea                 |       57 |     0.001% |          4 |   15099.73 |
| 145  | SB      | Solomon Islands        |       54 |     0.001% |         64 |     838.65 |
| 146  | MC      | Monaco                 |       53 |     0.001% |       1382 |      38.34 |
| 147  | BN      | Brunei                 |       47 |     0.001% |        101 |     466.33 |
| 148  | TM      | Turkmenistan           |       46 |     0.001% |          6 |    7618.85 |
| 148  | MO      | Macao                  |       46 |     0.001% |         64 |     722.00 |
| 150  | HT      | Haiti                  |       42 |    0.0010% |          4 |   11906.10 |
| 151  | GP      | Guadeloupe             |       41 |    0.0010% |        110 |     373.79 |
| 152  | NA      | Namibia                |       38 |    0.0009% |         12 |    3092.82 |
| 153  | ER      | Eritrea                |       37 |    0.0009% |         10 |    3607.00 |
| 154  | BZ      | Belize                 |       36 |    0.0008% |         85 |     422.92 |
| 155  | PR      | Puerto Rico            |       29 |    0.0007% |          9 |    3235.29 |
| 156  | AD      | Andorra                |       27 |    0.0006% |        326 |      82.90 |
| 157  | NE      | Niger                  |       26 |    0.0006% |        0.9 |   27917.83 |
| 158  | MR      | Mauritania             |       25 |    0.0006% |          5 |    5315.07 |
| 158  | LR      | Liberia                |       25 |    0.0006% |          4 |    5731.21 |
| 158  | BW      | Botswana               |       25 |    0.0006% |         10 |    2562.12 |
| 161  | SR      | Suriname               |       24 |    0.0006% |         38 |     639.85 |
| 161  | GA      | Gabon                  |       24 |    0.0006% |          9 |    2593.13 |
| 163  | SO      | Somalia                |       22 |    0.0005% |          1 |   19654.74 |
| 163  | KP      | North Korea            |       22 |    0.0005% |        0.8 |   26571.00 |
| 165  | XK      | Kosovo                 |       21 |    0.0005% |         13 |    1674.13 |
| 165  | CV      | Cape Verde             |       21 |    0.0005% |         40 |     527.33 |
| 167  | BI      | Burundi                |       19 |    0.0004% |          1 |   14390.00 |
| 168  | FJ      | Fiji                   |       18 |    0.0004% |         19 |     933.15 |
| 169  | KM      | Comoros                |       17 |    0.0004% |         19 |     882.85 |
| 170  | LI      | Liechtenstein          |       16 |    0.0004% |        399 |      40.13 |
| 170  | GY      | Guyana                 |       16 |    0.0004% |         19 |     835.99 |
| 172  | TD      | Chad                   |       14 |    0.0003% |        0.7 |   21003.71 |
| 173  | CW      | Curaçao                |       13 |    0.0003% |         70 |     185.49 |
| 174  | VA      | Vatican City           |       11 |    0.0003% |      22000 |       0.50 |
| 174  | NC      | New Caledonia          |       11 |    0.0003% |         37 |     295.33 |
| 176  | GW      | Guinea-Bissau          |       10 |    0.0002% |          4 |    2249.52 |
| 177  | PF      | French Polynesia       |        9 |    0.0002% |         32 |     282.47 |
| 178  | DJ      | Djibouti               |        7 |    0.0002% |          6 |    1184.08 |
| 178  | BT      | Bhutan                 |        7 |    0.0002% |          9 |     796.68 |
| 178  | BB      | Barbados               |        7 |    0.0002% |         25 |     282.62 |
| 181  | GL      | Greenland              |        6 |    0.0001% |        108 |      55.75 |
| 181  | FO      | Faroe Islands          |        6 |    0.0001% |        107 |      56.00 |
| 181  | CF      | Central African Repub… |        6 |    0.0001% |          1 |    5513.28 |
| 181  | BS      | Bahamas                |        6 |    0.0001% |         15 |     403.03 |
| 185  | TL      | Timor-Leste            |        5 |    0.0001% |          4 |    1418.52 |
| 185  | ST      | Sao Tome and Principe  |        5 |    0.0001% |         21 |     240.25 |
| 185  | AW      | Aruba                  |        5 |    0.0001% |         46 |     108.15 |
| 188  | VC      | Saint Vincent and the… |        4 |   0.00009% |         40 |      99.92 |
| 188  | SZ      | Eswatini               |        4 |   0.00009% |          3 |    1256.17 |
| 188  | SC      | Seychelles             |        4 |   0.00009% |         30 |     132.78 |
| 188  | PS      | Palestine, State of    |        4 |   0.00009% |        0.7 |    5589.62 |
| 188  | GQ      | Equatorial Guinea      |        4 |   0.00009% |          2 |    1938.43 |
| 188  | GI      | Gibraltar              |        4 |   0.00009% |        100 |      40.13 |
| 194  | NN      | Sint Maarten (Dutch p… |        3 |   0.00007% |         68 |      43.92 |
| 194  | LC      | Saint Lucia            |        3 |   0.00007% |         17 |     180.15 |
| 194  | GU      | Guam                   |        3 |   0.00007% |         18 |     169.00 |
| 194  | EH      | Western Sahara         |        3 |   0.00007% |          5 |     600.90 |
| 194  | EA      |                        |        3 |   0.00007% |            |            |
| 194  | DM      | Dominica               |        3 |   0.00007% |         46 |      65.87 |
| 194  | AS      | American Samoa         |        3 |   0.00007% |         65 |      46.03 |
| 194  | AI      | Anguilla               |        3 |   0.00007% |        204 |      14.73 |
| 202  | SS      | South Sudan            |        2 |   0.00005% |        0.2 |   12188.79 |
| 202  | SM      | San Marino             |        2 |   0.00005% |         60 |      33.57 |
| 202  | LS      | Lesotho                |        2 |   0.00005% |        0.8 |    2363.33 |
| 202  | KY      | Cayman Islands         |        2 |   0.00005% |         26 |      75.84 |
| 202  | AG      | Antigua and Barbuda    |        2 |   0.00005% |         21 |      94.21 |
| 207  | WS      | Samoa                  |        1 |   0.00002% |          5 |     219.31 |
| 207  | TO      | Tonga                  |        1 |   0.00002% |         10 |     103.74 |
| 207  | PW      | Palau                  |        1 |   0.00002% |         57 |      17.66 |
| 207  | NF      | Norfolk Island         |        1 |   0.00002% |            |            |
| 207  | KI      | Kiribati               |        1 |   0.00002% |          7 |     136.49 |
| 207  | IO      | British Indian Ocean … |        1 |   0.00002% |         25 |      39.73 |
| 207  | GD      | Grenada                |        1 |   0.00002% |          9 |     117.30 |
| 207  | FK      | Falkland Islands (Mal… |        1 |   0.00002% |        288 |       3.47 |
|      | World   | World                  |  4281261 |       100% |        520 | 8231613.07 |
---------------------------------------------------------------------------------------------

Downloading builds from http://stats.lineageos.org. Press 'b' to break downloads.

LineageOS builds by number of installs
---------------------------------------------------------------------------------------------------------------------------------------------
| Rank |      Build       |     Maker      |           Model           |     Processor      | Mod.Released | Status | Installs | % Installs |
---------------------------------------------------------------------------------------------------------------------------------------------
| 1    | channel          | Motorola       | moto g7 play              | Snapdragon 632     | 2019-03-01   | O      |   358931 |      8.38% |
| 2    | dipper           | Xiaomi         | Mi 8                      | Snapdragon 845     | 2018-07-01   | O      |   327949 |      7.66% |
| 3    | lake             | Motorola       | moto g7 plus              | Snapdragon 636     | 2019-02-01   | O      |   177659 |      4.15% |
| 4    | jeter            | Motorola       | moto g6 play              | Snapdragon 430     | 2018-05-01   | U      |   171750 |      4.01% |
| 5    | ocean            | Motorola       | moto g7 power             | Snapdragon 632     | 2019-02-01   | O      |   171521 |      4.00% |
| 6    | beyond0lte       | Samsung        | Galaxy S10e               | Exynos 9820        | 2019-03-08   | O      |   159686 |      3.73% |
| 7    | beyond1lte       | Samsung        | Galaxy S10                | Exynos 9820        | 2019-03-08   | O      |   152509 |      3.56% |
| 8    | waydroid_x86_64  | virtual        | Waydroid on x86_64        | x86                | 2021-07-01   | U      |   149382 |      3.49% |
| 9    | OP4AA7           | OPPO           | K5                        | Snapdragon 730G    | 2019-10-01   | U      |   125513 |      2.93% |
| 10   | sanders          | Motorola       | Moto G5S Plus             | Snapdragon 625     | 2017-08-01   | U      |   124006 |      2.90% |
| 11   | beyond2lte       | Samsung        | Galaxy S10+               | Exynos 9825        | 2019-08-23   | O      |   118445 |      2.77% |
| 12   | greatlte         | Samsung        | Galaxy Note 8             | Exynos 8895        | 2017-09-01   | U      |   106442 |      2.49% |
| 13   | hero2lte         | Samsung        | Galaxy S7 Edge            | Exynos 8890        | 2016-03-18   | D      |   105010 |      2.45% |
| 14   | herolte          | Samsung        | Galaxy S7                 | Exynos 8890        | 2016-03-18   | D      |    91311 |      2.13% |
| 15   | sagit            | Xiaomi         | Mi 6                      | Snapdragon 835     | 2017-04-01   | O      |    85692 |      2.00% |
| 16   | a71              | Samsung        | Galaxy A71                | Snapdragon 730     | 2020-01-17   | O      |    79509 |      1.86% |
| 17   | ugg              | Xiaomi         | Redmi Note 5A Prime, Red… | Snapdragon 435     | 2017-11-01   | U      |    63885 |      1.49% |
| 18   | A57              | OPPO           | A57 (2016)                | Snapdragon 435     | 2016-12-01   | U      |    63622 |      1.49% |
| 19   | HWPAR            | Huawei         | Nova 3                    | Kirin 970          | 2018-08-01   | U      |    62940 |      1.47% |
| 20   | R9               | OPPO           | R9                        | Helio P10          | 2016-03-01   | U      |    62755 |      1.47% |
| 21   | RMX2201CN        | Realme         | V3 5G                     | Dimensity 720      | 2020-09-10   | U      |    62679 |      1.46% |
| 22   | HWSEA-A          | Huawei         | Nova 5 Pro                | Kirin 980          | 2019-06-01   | U      |    62656 |      1.46% |
| 23   | PACM00           | OPPO           | R15 10                    | Helio P60          | 2018-04-01   | U      |    62514 |      1.46% |
| 24   | HWMAR            | Huawei         | P30 Lite                  | Kirin 710          | 2019-04-25   | U      |    62492 |      1.46% |
| 25   | prada            | LG             | Prada 3.0                 | OMAP 4430          | 2012-01-01   | U      |    62446 |      1.46% |
| 26   | HWDUB-Q          | Huawei         | Y7 Prime 2019             | Snapdragon 450     | 2019-01-01   | U      |    62150 |      1.45% |
| 27   | PBDM00           | OPPO           | R17 Pro / RX17 Pro        | Snapdragon 710     | 2018-11-01   | U      |    61879 |      1.44% |
| 28   | troika           | Motorola       | one action                | Exynos 9609        | 2019-10-31   | O      |    45248 |      1.06% |
| 29   | miatoll          | Xiaomi         | POCO M2 Pro, Redmi Note … | Snapdragon 720G    | 2020-03-17   | O      |    32149 |      0.75% |
| 30   | kane             | Motorola       | one vision, p50           | Exynos 9609        | 2019-05-15   | O      |    27268 |      0.64% |
| 31   | j8y18lte         | Samsung        | J8 (2018)                 | Snapdragon 450     | 2018-07-01   | U      |    27065 |      0.63% |
| 32   | river            | Motorola       | moto g7                   | Snapdragon 632     | 2019-02-01   | O      |    24482 |      0.57% |
| 33   | a20              | Samsung        | Galaxy A20                | Exynos 7884        | 2019-04-05   | U      |    24337 |      0.57% |
| 34   | zerofltexx       | Samsung        | Galaxy S6                 | Exynos 7420        | 2015-04-01   | D      |    23215 |      0.54% |
| 35   | nx_tab           | Nintendo       | Switch v1 [Tablet], Swit… | Tegra X1 (T210)    | 2017-03-03   | O      |    22043 |      0.51% |
| 36   | waydroid_arm64   | virtual        | Waydroid on ARM64         | ARM                | 2021-07-01   | U      |    19314 |      0.45% |
| 37   | tiffany          | Xiaomi         | Mi 5X                     | Snapdragon 625     | 2017-09-01   | U      |    17121 |      0.40% |
| 38   | karnak           | Amazon         | Fire HD 8                 | MediaTek MT8163    | 2018-10-04   | U      |    15617 |      0.36% |
| 39   | apollon          | Xiaomi         | Mi 10T, Mi 10T Pro, Redm… | Snapdragon 865     | 2020-10-01   | O      |    15002 |      0.35% |
| 40   | matissewifi      | Samsung        | Galaxy Tab 4 10.1 Wi-Fi   | Snapdragon 400     | 2014-06-01   | U      |    14027 |      0.33% |
| 41   | a70q             | Samsung        | Galaxy A70 (SM-A705)      | Snapdragon 675     | 2019-05-01   | U      |    12810 |      0.30% |
| 42   | lavender         | Xiaomi         | Redmi Note 7              | Snapdragon 660     | 2019-01-01   | D      |    12588 |      0.29% |
| 43   | tissot           | Xiaomi         | Mi A1                     | Snapdragon 625     | 2017-10-01   | D      |    12215 |      0.29% |
| 44   | n8000            | Samsung        | Galaxy Note 10.1          | Exynos 4 Quad 4412 | 2012-08-01   | U      |    10021 |      0.23% |
| 45   | j6primelte       | Samsung        | Galaxy J6+                | Snapdragon 425     | 2018-09-25   | U      |     9900 |      0.23% |
| 46   | dumpling         | OnePlus        | OnePlus 5T                | Snapdragon 835     | 2017-11-01   | O      |     9888 |      0.23% |
| 47   | p10              | Huawei         | P10                       | Kirin 960          | 2017-03-01   | U      |     8813 |      0.21% |
| 48   | on7xelte         | Samsung        | Galaxy J7 Prime           | Exynos 7870        | 2016-09-01   | U      |     8699 |      0.20% |
| 49   | rpi4             | Raspberry Pi   | Raspberry Pi 4            | Broadcom BCM2711   | 2019-06-24   | U      |     8109 |      0.19% |
| 50   | Mi439            | Xiaomi         | Redmi 7A, Redmi 8, Redmi… | Snapdragon 439     | 2019-05-28   | O      |     8022 |      0.19% |
| 51   | gemini           | Xiaomi         | Mi 5                      | Snapdragon 820     | 2016-04-01   | O      |     7804 |      0.18% |
| 52   | n8010            | Samsung        | Galaxy Note 10.1 (N8010)  | Exynos 4 Quad 4412 | 2012-08-01   | U      |     7503 |      0.18% |
| 53   | a30              | Samsung        | Galaxy A30                | Exynos 7904        | 2019-03-01   | U      |     7501 |      0.18% |
| 54   | gtel3g           | Samsung        | Galaxy Tab E              | Spreadtrum SC7730S | 2015-07-01   | U      |     7391 |      0.17% |
| 55   | mustang          | Amazon         | Fire 7 (2019)             | Mediatek MT8163    | 2019-06-06   | U      |     6756 |      0.16% |
| 56   | whyred           | Xiaomi         | Redmi Note 5 Pro          | Snapdragon 636     | 2018-02-01   | D      |     6707 |      0.16% |
| 57   | j4primelte       | Samsung        | Galaxy J4+                | Snapdragon 425     | 2018-10-01   | U      |     6478 |      0.15% |
| 58   | gtaxlwifi        | Samsung        | Galaxy Tab A 10.1" (2016) | Exynos 7870 Octa   | 2016-05-01   | U      |     6433 |      0.15% |
| 59   | sweet            | Xiaomi         | Redmi Note 10 Pro, Redmi… | Snapdragon 732G    | 2021-03-01   | O      |     6333 |      0.15% |
| 60   | crownlte         | Samsung        | Galaxy Note 9             | Exynos 9810        | 2018-08-09   | D      |     6315 |      0.15% |
| 61   | douglas          | Amazon         | Fire HD 8 (2017)          | MediaTek MT8163    | 2017-06-01   | U      |     6253 |      0.15% |
| 62   | ford             | Amazon         | Fire 7" (ford)            | MediaTek MT8127    | 2015-11-01   | U      |     6073 |      0.14% |
| 63   | espresso3g       | Samsung        | Galaxy Tab 2 7.0 (GSM), … | OMAP 4430          | 2012-04-01   | D      |     5897 |      0.14% |
| 64   | santos10wifi     | Samsung        | Galaxy Tab III 10.1       | Atom Z2560         | 2013-07-07   | U      |     5699 |      0.13% |
| 65   | starlte          | Samsung        | Galaxy S9                 | Exynos 9810        | 2018-03-11   | D      |     5669 |      0.13% |
| 66   | TB8703           | Lenovo         | TAB 3 8 Plus              | Snapdragon 625     | 2017-03-01   | U      |     5599 |      0.13% |
| 67   | ginkgo           | Xiaomi         | Redmi Note 8, Redmi Note… | Snapdragon 665     | 2019-08-01   | O      |     5565 |      0.13% |
| 68   | Mi8937           | Xiaomi         | Redmi 3S, Redmi 3X, Redm… | Snapdragon 430     | 2016-06-14   | O      |     5331 |      0.12% |
| 69   | star2lte         | Samsung        | Galaxy S9+                | Exynos 9810        | 2018-03-11   | D      |     5192 |      0.12% |
| 70   | core33g          | Samsung        | Galaxy Core Prime (SM-G3… | Snapdragon 410     | 2014-11-01   | U      |     5151 |      0.12% |
| 71   | beryllium        | Xiaomi         | POCO F1                   | Snapdragon 845     | 2018-08-01   | O      |     5149 |      0.12% |
| 72   | alioth           | Xiaomi         | POCO F3, Redmi K40, Mi 1… | Snapdragon 870     | 2021-02-01   | O      |     5014 |      0.12% |
| 73   | enchilada        | OnePlus        | OnePlus 6                 | Snapdragon 845     | 2018-04-01   | O      |     4982 |      0.12% |
| 74   | m20lte           | Samsung        | Galaxy M20                | Exynos 7904        | 2019-01-28   | D      |     4927 |      0.12% |
| 75   | fajita           | OnePlus        | OnePlus 6T, OnePlus 6T (… | Snapdragon 845     | 2018-11-01   | O      |     4867 |      0.11% |
| 76   | rpi5             | Raspberry Pi   | Raspberry Pi 5            | Broadcom BCM2712   | 2023-10-23   | U      |     4855 |      0.11% |
| 77   | a5y17lte         | Samsung        | Galaxy A5 (2017)          | Exynos 7880        | 2017-01-02   | D      |     4662 |      0.11% |
| 78   | klte             | Samsung        | Galaxy S5 LTE (G900F/M/R… | Snapdragon 801     | 2014-04-11   | D      |     4639 |      0.11% |
| 79   | n1awifi          | Samsung        | Galaxy Note 10.1 Wi-Fi (… | Exynos 5420        | 2013-10-10   | D      |     4571 |      0.11% |
| 80   | clover           | Xiaomi         | Xiaomi Mi Pad 4           | Snapdragon 660     | 2018-06-25   | U      |     4451 |      0.10% |
| 81   | j7elte           | Samsung        | Galaxy J7 (2015)          | Exynos 7580        | 2015-06-01   | D      |     4339 |      0.10% |
| 82   | r8q              | Samsung        | Galaxy S20 FE, Galaxy S2… | Snapdragon 865     | 2020-10-02   | O      |     4336 |      0.10% |
| 83   | cheeseburger     | OnePlus        | OnePlus 5                 | Snapdragon 835     | 2017-06-01   | O      |     4335 |      0.10% |
| 84   | mido             | Xiaomi         | Redmi Note 4              | Snapdragon 625     | 2017-01-01   | D      |     4246 |      0.10% |
| 85   | coral            | Google         | Pixel 4 XL                | Snapdragon 855     | 2019-09-01   | O      |     4175 |      0.10% |
| 86   | blueline         | Google         | Pixel 3                   | Snapdragon 845     | 2018-10-01   | O      |     4021 |      0.09% |
| 87   | sunfish          | Google         | Pixel 4a                  | Snapdragon 730G    | 2020-08-01   | O      |     3955 |      0.09% |
| 88   | hlte             | Samsung        | Galaxy Note 3 LTE (N9005… | Snapdragon 800     | 2013-09-01   | D      |     3749 |      0.09% |
| 89   | blossom          | Xiaomi         | Redmi 9A, Redmi 9C, Redm… | Helio G25 / G35    | 2020-07-07   | U      |     3727 |      0.09% |
| 90   | harpia           | Motorola       | moto g4 play              | Snapdragon 410     | 2016-05-01   | D      |     3699 |      0.09% |
| 91   | gtexslte         | Samsung        | Galaxy Tab A 7.0 LTE (20… | Snapdragon 410     | 2016-03-01   | U      |     3605 |      0.08% |
| 92   | rosemary         | Xiaomi         | Redmi Note 10S, Redmi No… | Helio G95          | 2021-04-01   | O      |     3532 |      0.08% |
| 93   | laurel_sprout    | Xiaomi         | Mi A3                     | Snapdragon 665     | 2019-07-01   | O      |     3487 |      0.08% |
| 94   | wayne            | Xiaomi         | Mi 6X                     | Snapdragon 660     | 2018-04-01   | D      |     3475 |      0.08% |
| 95   | chiron           | Xiaomi         | Mi MIX 2                  | Snapdragon 835     | 2017-09-01   | O      |     3471 |      0.08% |
| 96   | instantnoodlep   | OnePlus        | OnePlus 8 Pro             | Snapdragon 865     | 2020-04-01   | O      |     3430 |      0.08% |
| 97   | mocha            | Xiaomi         | Mi Pad 1                  | Tegra K1 (T124)    | 2014-06-01   | U      |     3426 |      0.08% |
| 98   | montana          | Motorola       | moto g5s                  | Snapdragon 430     | 2017-08-01   | D      |     3356 |      0.08% |
| 99   | austin           | Amazon         | Fire 7" (Austin)          | MediaTek MT8127    | 2017-06-01   | U      |     3348 |      0.08% |
| 100  | flo              | Google         | Nexus 7 (Wi-Fi, 2013 ver… | Snapdragon S4 Pro  | 2013-07-26   | D      |     3314 |      0.08% |
| 101  | sargo            | Google         | Pixel 3a                  | Snapdragon 670     | 2019-04-01   | O      |     3298 |      0.08% |
| 102  | espressowifi     | Samsung        | Galaxy Tab 2 7.0 (Wi-Fi … | OMAP 4430          | 2012-05-01   | D      |     3182 |      0.07% |
| 103  | vayu             | Xiaomi         | POCO X3 Pro               | Snapdragon 860     | 2021-03-01   | O      |     3113 |      0.07% |
| 104  | santos103g       | Samsung        | Galaxy Tab III 10.1       | Atom Z2560         | 2013-07-07   | U      |     3095 |      0.07% |
| 105  | guacamole        | OnePlus        | OnePlus 7 Pro, OnePlus 7… | Snapdragon 855     | 2019-05-01   | O      |     3068 |      0.07% |
| 106  | evert            | Motorola       | moto g6 plus              | Snapdragon 630     | 2018-05-01   | O      |     3060 |      0.07% |
| 107  | nx563j           | Nubia          | Z17                       | Snapdragon 835     | 2017-06-01   | O      |     3029 |      0.07% |
| 108  | redfin           | Google         | Pixel 5                   | Snapdragon 765G 5G | 2020-10-01   | O      |     2945 |      0.07% |
| 109  | surya            | Xiaomi         | POCO X3 NFC               | Snapdragon 732G    | 2020-09-08   | O      |     2936 |      0.07% |
| 110  | gta4xlwifi       | Samsung        | Galaxy Tab S6 Lite (Wi-F… | Exynos 9611        | 2020-04-02   | O      |     2867 |      0.07% |
| 111  | kebab            | OnePlus        | OnePlus 8T, OnePlus 8T (… | Snapdragon 865     | 2020-10-01   | O      |     2863 |      0.07% |
| 112  | lmi              | Xiaomi         | POCO F2 Pro, Redmi K30 P… | Snapdragon 865     | 2020-03-01   | D      |     2807 |      0.07% |
| 113  | gtaxllte         | Samsung        | Galaxy Tab A (SM-T580)    | Exynos 7870 Octa   | 2016-05-01   | U      |     2801 |      0.07% |
| 114  | onclite          | Xiaomi         | Redmi 7, Redmi Y3         | Snapdragon 632     | 2019-03-01   | D      |     2763 |      0.06% |
| 115  | chagallwifi      | Samsung        | Galaxy Tab S 10.5 Wi-Fi … | Exynos 5420        | 2014-07-01   | D      |     2694 |      0.06% |
| 116  | chagalllte       | Samsung        | Galaxy Tab S 10.5 LTE     | Exynos 5420        | 2014-07-01   | D      |     2677 |      0.06% |
| 117  | viennalte        | Samsung        | Galaxy Note Pro 12.2      | Exynos 5420 Octa   | 2014-02-13   | U      |     2676 |      0.06% |
| 118  | n5100            | Samsung        | Galaxy Note 8.0 (GSM)     | Exynos 4412        | 2013-04-01   | D      |     2657 |      0.06% |
| 119  | R11              | OPPO           | R11                       | Snapdragon 660     | 2017-06-01   | U      |     2648 |      0.06% |
| 120  | merlinx          | Xiaomi         | Redmi Note 9              | Helio G85          | 2020-05-01   | D      |     2643 |      0.06% |
| 121  | A37              | OPPO           | A37, A37f, A37fw          | Snapdragon 410     | 2016-06-01   | U      |     2588 |      0.06% |
| 122  | x2               | LeEco          | Le Max2                   | Snapdragon 820     | 2016-04-01   | D      |     2569 |      0.06% |
| 123  | x86_64_tv        | virtual        | Android TV on x86_64      | x86                |              | U      |     2478 |      0.06% |
| 124  | gts4lvwifi       | Samsung        | Galaxy Tab S5e (Wi-Fi)    | Snapdragon 670     | 2019-04-01   | O      |     2470 |      0.06% |
| 125  | lemonade         | OnePlus        | OnePlus 9, OnePlus 9 (T-… | Snapdragon 888     | 2021-03-01   | O      |     2460 |      0.06% |
| 126  | matisse3g        | Samsung        | Galaxy Tab 4 10.1 3G      | Snapdragon 400     | 2014-06-01   | U      |     2433 |      0.06% |
| 127  | lemonadep        | OnePlus        | OnePlus 9 Pro, OnePlus 9… | Snapdragon 888     | 2021-03-01   | O      |     2395 |      0.06% |
| 128  | davinci          | Xiaomi         | Mi 9T, Redmi K20 (China)… | Snapdragon 730     | 2019-06-01   | O      |     2388 |      0.06% |
| 129  | gtexswifi        | Samsung        | Galaxy Tab A 7.0          | Spreadtrum SC8830  | 2016-03-01   | U      |     2330 |      0.05% |
| 130  | a10              | Samsung        | Galaxy A10                | Exynos 7884        | 2019-03-01   | U      |     2323 |      0.05% |
| 131  | oneplus3         | OnePlus        | OnePlus 3, OnePlus 3T     | Snapdragon 820     | 2016-06-01   | D      |     2234 |      0.05% |
| 132  | bacon            | OnePlus        | OnePlus One               | Snapdragon 801     | 2014-06-06   | D      |     2225 |      0.05% |
| 133  | i9300            | Samsung        | Galaxy S III (Internatio… | Exynos 4412        | 2012-05-29   | D      |     2210 |      0.05% |
| 134  | mondrianwifi     | Samsung        | Galaxy Tab Pro 8.4        | Snapdragon 800     | 2014-01-01   | D      |     2125 |      0.05% |
| 135  | garden           | Xiaomi         | Redmi 9A, Redmi 9C        | Helio G25          | 2020-07-07   | U      |     2120 |      0.05% |
| 136  | gts210vewifi     | Samsung        | Galaxy Tab S2 9.7 Wi-Fi … | Snapdragon 652     | 2016-08-01   | D      |     2023 |      0.05% |
| 137  | j5xnlte          | Samsung        | Galaxy J5 (J510MN/GN/FN)  | Snapdragon 410     | 2016-04-01   | U      |     2000 |      0.05% |
| 138  | taimen           | Google         | Pixel 2 XL                | Snapdragon 835     | 2017-10-01   | O      |     1998 |      0.05% |
| 139  | star2qltechn     | Samsung        | Galaxy S9+                | Snapdragon 845     | 2018-03-16   | U      |     1991 |      0.05% |
| 140  | matisselte       | Samsung        | Galaxy Tab 4 10.1 LTE     | Snapdragon 400     | 2014-05-01   | U      |     1989 |      0.05% |
| 141  | gta4lwifi        | Samsung        | Galaxy Tab A7 10.4 2020 … | Snapdragon 662     | 2020-09-01   | O      |     1959 |      0.05% |
| 142  | cactus           | Xiaomi         | Redmi 6A                  | Helio A22          | 2018-06-15   | U      |     1950 |      0.05% |
| 143  | noblelte         | Samsung        | Galaxy Note 5             | Exynos 7420 Octa   | 2015-08-21   | U      |     1924 |      0.04% |
| 144  | serranoltexx     | Samsung        | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |     1911 |      0.04% |
| 145  | vince            | Xiaomi         | Redmi 5 Plus              | Snapdragon 625     | 2017-12-07   | U      |     1875 |      0.04% |
| 146  | potter           | Motorola       | Moto G5 Plus              | Snapdragon 625     | 2017-04-01   | U      |     1870 |      0.04% |
| 147  | lancelot         | Xiaomi         | Redmi 9                   | Helio G85          | 2020-06-01   | D      |     1772 |      0.04% |
| 148  | crosshatch       | Google         | Pixel 3 XL                | Snapdragon 845     | 2018-10-01   | O      |     1771 |      0.04% |
| 149  | hotdogb          | OnePlus        | OnePlus 7T, OnePlus 7T (… | Snapdragon 855+    | 2019-09-01   | O      |     1768 |      0.04% |
| 150  | polaris          | Xiaomi         | Mi MIX 2S                 | Snapdragon 845     | 2018-04-01   | O      |     1765 |      0.04% |
| 151  | lisa             | Xiaomi         | Xiaomi 11 Lite 5G NE, Xi… | Snapdragon 778G 5G | 2021-09-01   | O      |     1764 |      0.04% |
| 152  | walleye          | Google         | Pixel 2                   | Snapdragon 835     | 2017-10-01   | O      |     1763 |      0.04% |
| 153  | umi              | Xiaomi         | Mi 10                     | Snapdragon 865     | 2020-02-01   | O      |     1762 |      0.04% |
| 154  | a7y17lte         | Samsung        | Galaxy A7 (2017)          | Exynos 7880        | 2017-01-02   | D      |     1744 |      0.04% |
| 155  | instantnoodle    | OnePlus        | OnePlus 8, OnePlus 8 (T-… | Snapdragon 865     | 2020-04-01   | O      |     1737 |      0.04% |
| 156  | android_x86_64   | virtual        | Android on x86_64         | x86                |              | U      |     1730 |      0.04% |
| 157  | treltexx         | Samsung        | Galaxy Note 4             | Exynos 5433 Octa   | 2014-10-01   | U      |     1725 |      0.04% |
| 158  | n2awifi          | Samsung        | Galaxy Tab PRO 10.1       | Exynos 5420        | 2014-02-01   | D      |     1717 |      0.04% |
| 159  | X00TD            | ASUS           | Zenfone Max Pro M1        | Snapdragon 636     | 2018-05-01   | D      |     1700 |      0.04% |
| 160  | renoir           | Xiaomi         | Mi 11 Lite 5G             | Snapdragon 780G 5G | 2021-03-01   | O      |     1657 |      0.04% |
| 161  | tulip            | ZTE            | Axon 7 Mini               | Snapdragon 617     | 2016-09-01   | D      |     1655 |      0.04% |
| 162  | avicii           | OnePlus        | OnePlus Nord              | Snapdragon 765G    | 2020-07-21   | D      |     1643 |      0.04% |
| 162  | a52sxq           | Samsung        | Galaxy A52s 5G            | Snapdragon 778G 5G | 2021-09-01   | O      |     1643 |      0.04% |
| 164  | hammerhead       | Google         | Nexus 5                   | Snapdragon 800     | 2013-10-31   | D      |     1606 |      0.04% |
| 165  | y2s              | Samsung        | Galaxy S20+, Galaxy S20+… | Exynos 990         | 2020-03-06   | O      |     1588 |      0.04% |
| 166  | beyondx          | Samsung        | Galaxy S10 5G             | Exynos 9820        | 2019-03-08   | O      |     1575 |      0.04% |
| 167  | a5xelte          | Samsung        | Galaxy A5 (2016)          | Exynos 7580        | 2015-12-01   | D      |     1569 |      0.04% |
| 168  | a6lte            | Samsung        | Galaxy A6 (Exynos7870)    | Exynos 7870        | 2018-05-01   | U      |     1561 |      0.04% |
| 169  | a21s             | Samsung        | Galaxy A21s               | Exynos 850         | 2020-06-02   | O      |     1549 |      0.04% |
| 170  | gta4l            | Samsung        | Galaxy Tab A7 10.4 2020 … | Snapdragon 662     | 2020-09-01   | O      |     1545 |      0.04% |
| 171  | flox             | Google         | Nexus 7 2013 (Wi-Fi, Rep… | Snapdragon S4 Pro  | 2013-07-26   | D      |     1536 |      0.04% |
| 172  | bonito           | Google         | Pixel 3a XL               | Snapdragon 670     | 2019-04-01   | O      |     1488 |      0.03% |
| 173  | kenzo            | Xiaomi         | Redmi Note 3              | Snapdragon 650     | 2016-02-01   | D      |     1484 |      0.03% |
| 174  | starqltechn      | Samsung        | Galaxy S9                 | Snapdragon 845     | 2018-03-16   | U      |     1461 |      0.03% |
| 175  | marble           | Xiaomi         | POCO F5 (Global), POCO F… | Snapdragon 7+ Gen… | 2023-03-28   | O      |     1446 |      0.03% |
| 176  | suez             | Amazon         | Fire HD 10                | MediaTek MT8173    | 2017-06-01   | U      |     1432 |      0.03% |
| 177  | a3xelte          | Samsung        | Galaxy A3 (2016)          | Exynos 7578        | 2015-12-01   | D      |     1425 |      0.03% |
| 178  | jfltexx          | Samsung        | Galaxy S4 (GT-I9505, SGH… | Snapdragon 600     | 2013-04-01   | D      |     1416 |      0.03% |
| 179  | libra            | Xiaomi         | Mi 4c                     | Snapdragon 808     | 2015-09-01   | D      |     1396 |      0.03% |
| 180  | bluejay          | Google         | Pixel 6a                  | Tensor GS101       | 2022-07-01   | O      |     1384 |      0.03% |
| 181  | helium           | Xiaomi         | Mi Max                    | Snapdragon 652     | 2016-05-01   | U      |     1335 |      0.03% |
| 182  | deen             | Motorola       | One                       | Snapdragon 625     | 2020-07-02   | U      |     1333 |      0.03% |
| 183  | ms013g           | Samsung        | Galaxy Grand 2 Duos       | Snapdragon 400     | 2013-11-25   | D      |     1328 |      0.03% |
| 184  | n7100            | Samsung        | Galaxy Note II            | Exynos 4412 Quad   | 2012-10-01   | U      |     1321 |      0.03% |
| 184  | grandppltedx     | Samsung        | Galaxy J2 Prime / Grand … | MediaTek MT6737T   | 2016-11-01   | U      |     1321 |      0.03% |
| 186  | gts4lv           | Samsung        | Galaxy Tab S5e (LTE)      | Snapdragon 670     | 2019-04-01   | O      |     1316 |      0.03% |
| 187  | TBX704           | Lenovo         | Tab 4 10 Plus             | Snapdragon 625     | 2017-07-01   | U      |     1311 |      0.03% |
| 188  | tokay            | Google         | Pixel 9                   | Tensor G4          | 2024-08-22   | O      |     1293 |      0.03% |
| 189  | certus           | Xiaomi         | Redmi 6 / 6A              | Helio A22          | 2018-06-01   | U      |     1283 |      0.03% |
| 190  | gauguin          | Xiaomi         | Mi 10T Lite 5G, Mi 10i 5… | Snapdragon 750G 5G | 2020-10-01   | O      |     1273 |      0.03% |
| 191  | gt58wifi         | Samsung        | Tab A 2015 8.0 (SM-T350)  | Snapdragon 410     | 2015-05-01   | U      |     1270 |      0.03% |
| 192  | grus             | Xiaomi         | Mi 9 SE                   | Snapdragon 712     | 2019-02-01   | O      |     1263 |      0.03% |
| 193  | D22AP            | virtual        | Android 12 (API 22)       |                    |              | U      |     1248 |      0.03% |
| 194  | waydroid_tv_x86… | virtual        |                           | X86_64             |              | U      |     1218 |      0.03% |
| 194  | cedric           | Motorola       | moto g5                   | Snapdragon 430     | 2017-03-01   | D      |     1218 |      0.03% |
| 196  | waydroid_x86     | virtual        | Waydroid on i386          | x86                | 2021-07-01   | U      |     1217 |      0.03% |
| 197  | pioneer          | Sony           | Xperia XA2                | Snapdragon 630     | 2018-02-01   | O      |     1193 |      0.03% |
| 198  | v1awifi          | Samsung        | Galaxy Note Pro 12.2 Wi-… | Exynos 5420        | 2014-02-01   | D      |     1188 |      0.03% |
| 199  | a52q             | Samsung        | Galaxy A52 4G             | Snapdragon 720G    | 2021-03-26   | O      |     1179 |      0.03% |
| 200  | fogos            | Motorola       | moto g34 5G, moto g45 5G  | Snapdragon 695     | 2023-12-29   | O      |     1178 |      0.03% |
| 200  | FP3              | Fairphone      | Fairphone 3, Fairphone 3+ | Snapdragon 632     | 2019-09-01   | O      |     1178 |      0.03% |
| 202  | flame            | Google         | Pixel 4                   | Snapdragon 855     | 2019-09-01   | O      |     1169 |      0.03% |
| 203  | r36s             | R36S           | R36S with Panel 4         | Rockchip RK3326    | 2025-05-31   | U      |     1167 |      0.03% |
| 204  | oneplus2         | OnePlus        | OnePlus 2                 | Snapdragon 810     | 2015-08-28   | D      |     1137 |      0.03% |
| 205  | klimtwifi        | Samsung        | Galaxy Tab S 8.4 Wi-Fi    | Exynos 5420        | 2014-07-01   | D      |     1135 |      0.03% |
| 205  | a7y18lte         | Samsung        | Galaxy A7 (2018)          | Exynos 7 Octa 7885 | 2018-10-01   | U      |     1135 |      0.03% |
| 207  | xmsirius         | Xiaomi         | Mi 8 SE                   | Snapdragon 710     | 2018-06-01   | D      |     1132 |      0.03% |
| 208  | j5lte            | Samsung        | Galaxy J5 (2015)          | Snapdragon 410     | 2015-06-26   | U      |     1121 |      0.03% |
| 209  | lilac            | Sony           | Xperia XZ1 Compact        | Snapdragon 835     | 2017-10-01   | U      |     1119 |      0.03% |
| 210  | violet           | Xiaomi         | Redmi Note 7 Pro          | Snapdragon 675     | 2019-03-13   | O      |     1108 |      0.03% |
| 211  | rpi3             | Raspberry Pi   | Raspberry Pi 3            | Broadcom BCM2837   | 2016-02-29   | U      |     1090 |      0.03% |
| 212  | nx               | Nintendo       | Switch v1 [Android TV], … | Tegra X1 (T210)    | 2017-03-03   | O      |     1074 |      0.03% |
| 213  | osborn           | Smartisan      | Nut Pro 2, U3 Pro         | Snapdragon 660     | 2017-11-09   | U      |     1060 |      0.02% |
| 214  | daisy            | Xiaomi         | Mi A2 Lite                | Snapdragon 625     | 2018-07-01   | U      |     1054 |      0.02% |
| 215  | FP4              | Fairphone      | Fairphone 4               | Snapdragon 750G    | 2021-10-01   | O      |     1053 |      0.02% |
| 216  | devon            | Motorola       | moto g32                  | Snapdragon 680 4G  | 2022-08-01   | O      |     1052 |      0.02% |
| 217  | ysl              | Xiaomi         | Redmi S2, Redmi Y2        | Snapdragon 625     | 2018-05-01   | U      |     1033 |      0.02% |
| 218  | merlin           | Motorola       | moto g3 turbo             | Snapdragon 615     | 2015-11-01   | D      |     1021 |      0.02% |
| 218  | mata             | Essential      | PH-1                      | Snapdragon 835     | 2017-08-01   | O      |     1021 |      0.02% |
| 220  | n8013            | Samsung        | Galaxy Note 10.1 WiFi     | Exynos 4412        | 2012-08-01   | U      |     1019 |      0.02% |
| 221  | guacamoleb       | OnePlus        | OnePlus 7                 | Snapdragon 855     | 2019-05-01   | O      |     1018 |      0.02% |
| 222  | n5110            | Samsung        | Galaxy Note 8.0 (Wi-Fi)   | Exynos 4412        | 2013-04-01   | D      |     1003 |      0.02% |
| 223  | lt01wifi         | Samsung        | Galaxy Tab 3 8.0 (SM-T31… | Exynos 4 Dual 4212 | 2013-07-01   | U      |      990 |      0.02% |
| 224  | bangkk           | Motorola       | moto g84 5G               | Snapdragon 695     | 2023-09-08   | O      |      983 |      0.02% |
| 225  | hydrogen         | Xiaomi         | Mi Max                    | Snapdragon 650     | 2016-05-01   | D      |      982 |      0.02% |
| 226  | lynx             | Google         | Pixel 7a                  | Tensor GS201       | 2023-05-10   | O      |      976 |      0.02% |
| 227  | gts3lwifi        | Samsung        | Galaxy Tab S3 WiFi        | Snapdragon 820     | 2017-03-24   | U      |      975 |      0.02% |
| 228  | gt510wifi        | Samsung        | Tab A 2015 9.7 SM-T550    | Snapdragon 410     | 2015-05-01   | U      |      973 |      0.02% |
| 228  | d2s              | Samsung        | Galaxy Note10+            | Exynos 9825        | 2019-08-23   | O      |      973 |      0.02% |
| 230  | armani           | Xiaomi         | Redmi 1S                  | Snapdragon 400     | 2014-05-01   | D      |      972 |      0.02% |
| 231  | hltekor          | Samsung        | Galaxy Note 3 LTE (N900K… | Snapdragon 800     | 2013-09-01   | D      |      969 |      0.02% |
| 232  | panther          | Google         | Pixel 7                   | Tensor GS201       | 2022-10-13   | O      |      968 |      0.02% |
| 233  | Mi8917           | Xiaomi         | Redmi 4A, Redmi 5A, Redm… | Snapdragon 425     | 2016-11-04   | O      |      957 |      0.02% |
| 234  | xz2c             | Sony           | Xperia XZ2 Compact        | Snapdragon 845     | 2018-04-01   | O      |      948 |      0.02% |
| 235  | klimtlte         | Samsung        | Galaxy Tab S 10.5 LTE (S… | Exynos 5 Octa 5420 | 2014-07-01   | U      |      941 |      0.02% |
| 236  | bramble          | Google         | Pixel 4a 5G               | Snapdragon 765G    | 2020-10-01   | O      |      940 |      0.02% |
| 237  | fog              | Xiaomi         | Redmi 10C                 | Snapdragon 680 4G  | 2022-03-23   | U      |      935 |      0.02% |
| 238  | payton           | Motorola       | moto x4                   | Snapdragon 630     | 2017-10-01   | O      |      928 |      0.02% |
| 239  | joan             | LG             | V30 (Unlocked), V30 (T-M… | Snapdragon 835     | 2017-08-01   | O      |      926 |      0.02% |
| 240  | Mi8937_4_19      | Xiaomi         | Redmi 4X                  | Snapdragon 435     | 2017-02-28   | U      |      923 |      0.02% |
| 241  | ha3g             | Samsung        | Galaxy Note 3 (Internati… | Exynos 5420        | 2013-09-01   | D      |      921 |      0.02% |
| 242  | rhode            | Motorola       | moto g52                  | Snapdragon 680 4G  | 2022-04-01   | O      |      911 |      0.02% |
| 243  | peridot          | Xiaomi         | Poco F6, Redmi Turbo 3    | Snapdragon 8s Gen… | 2024-05-23   | U      |      908 |      0.02% |
| 244  | gta4xlveu        | Samsung        | Galaxy Tab S6 Lite        | Snapdragon 732G o… | 2022-05-23   | U      |      903 |      0.02% |
| 245  | oriole           | Google         | Pixel 6                   | Tensor GS101       | 2021-10-19   | O      |      885 |      0.02% |
| 246  | gts210wifi       | Samsung        | Galaxy Tab S2 9.7 (Wi-Fi) | Exynos 5433        | 2015-09-01   | D      |      880 |      0.02% |
| 247  | gts28vewifi      | Samsung        | Galaxy Tab S2 8.0 Wi-Fi … | Snapdragon 652     | 2015-09-01   | D      |      877 |      0.02% |
| 248  | gts210ltexx      | Samsung        | Galaxy Tab S2 9.7 (LTE)   | Exynos 5433        | 2015-09-01   | D      |      867 |      0.02% |
| 249  | android_x86      | virtual        | Android on x86            | x86                |              | U      |      865 |      0.02% |
| 250  | n8020            | Samsung        | Galaxy Note 10.1 (N8020)  | Exynos 4 Quad 4412 | 2012-12-01   | U      |      862 |      0.02% |
| 251  | gtowifi          | Samsung        | Galaxy Tab A 8.0 (2019)   | Snapdragon 429     | 2019-07-01   | O      |      860 |      0.02% |
| 252  | PL2              | Nokia          | Nokia 6.1 (2018)          | Snapdragon 630     | 2018-05-06   | O      |      851 |      0.02% |
| 253  | pyxis            | Xiaomi         | Mi CC 9, Mi 9 Lite        | Snapdragon 665     | 2019-07-01   | O      |      846 |      0.02% |
| 253  | larry            | OnePlus        | OnePlus Nord CE 3 Lite 5… | Snapdragon 695     | 2023-04-11   | O      |      846 |      0.02% |
| 255  | s5neolte         | Samsung        | Galaxy S5 Neo             | Exynos 7580        | 2015-08-01   | D      |      843 |      0.02% |
| 255  | gtanotexlwifi    | Samsung        | Galaxy Tab A 10.1 S Pen … | Exynos 7870 Octa   | 2016-10-01   | U      |      843 |      0.02% |
| 255  | checkers         | Amazon         | Echo Show 5               | MediaTek MT8163    | 2019-06-01   | U      |      843 |      0.02% |
| 258  | rosy             | Xiaomi         | Redmi 5                   | Snapdragon 450     | 2017-12-01   | U      |      838 |      0.02% |
| 259  | guamp            | Motorola       | moto g9 play, moto g9, K… | Snapdragon 662     | 2020-08-01   | O      |      833 |      0.02% |
| 260  | s2               | LeEco          | Le 2                      | Snapdragon 652     | 2016-04-01   | D      |      824 |      0.02% |
| 260  | ali              | Motorola       | Moto G6, Moto 1S          | Snapdragon 450     | 2018-04-01   | U      |      824 |      0.02% |
| 262  | spes             | Xiaomi         | Redmi Note 11             | Snapdragon 680     | 2022-02-09   | U      |      814 |      0.02% |
| 263  | sofiar           | Motorola       | G8 Power                  | Snapdragon 665     | 2020-04-16   | U      |      808 |      0.02% |
| 264  | YTX703F          | Lenovo         | Yoga Tab 3 Plus Wi-Fi     | Snapdragon 652     | 2016-12-01   | D      |      806 |      0.02% |
| 265  | osprey           | Motorola       | moto g (2015)             | Snapdragon 410     | 2015-07-01   | D      |      800 |      0.02% |
| 266  | a51              | Samsung        | Galaxy A51 (SM-A515F)     | Exynos 9611        | 2019-12-16   | U      |      799 |      0.02% |
| 267  | grandneove3g     | Samsung        | Galaxy Grand Neo Plus     | Spreadtrum SC8830  | 2015-01-01   | U      |      798 |      0.02% |
| 268  | lt03lte          | Samsung        | Galaxy Note 10.1 2014 (L… | Snapdragon 800     | 2013-10-01   | D      |      791 |      0.02% |
| 269  | shamu            | Google         | Nexus 6                   | Snapdragon 805     | 2014-10-29   | D      |      785 |      0.02% |
| 269  | kiev             | Motorola       | moto g 5G, moto one 5G a… | Snapdragon 750G    | 2020-05-01   | O      |      785 |      0.02% |
| 269  | jason            | Xiaomi         | Mi Note 3                 | Snapdragon 660     | 2017-09-01   | D      |      785 |      0.02% |
| 272  | jasmine_sprout   | Xiaomi         | Mi A2                     | Snapdragon 660     | 2018-07-01   | D      |      784 |      0.02% |
| 273  | j2y18lte         | Samsung        | Galaxy J2 2018            | Snapdragon 425     | 2018-01-01   | U      |      782 |      0.02% |
| 274  | gts3llte         | Samsung        | Galaxy Tab S3 9.7 LTE (S… | Snapdragon 820     | 2017-04-01   | U      |      781 |      0.02% |
| 275  | trlte            | Samsung        | Galaxy Note 4 (SM-N910F/… | Snapdragon 805     | 2014-10-01   | U      |      779 |      0.02% |
| 275  | cepheus          | Xiaomi         | Mi 9                      | Snapdragon 855     | 2019-03-25   | U      |      779 |      0.02% |
| 277  | bullhead         | Google         | Nexus 5X                  | Snapdragon 808     | 2015-09-29   | D      |      778 |      0.02% |
| 278  | ginna            | Motorola       | Moto E (2020)             | Snapdragon 632     | 2020-06-10   | U      |      772 |      0.02% |
| 279  | gtelwifiue       | Samsung        | Galaxy Tab E 9.6 (WiFi)   | Snapdragon 410     | 2015-07-01   | D      |      769 |      0.02% |
| 280  | earth            | Xiaomi         | Redmi 12C, Redmi 12C NFC… | Helio G85          | 2023-01-01   | O      |      762 |      0.02% |
| 281  | nash             | Motorola       | moto z2 force, moto z (2… | Snapdragon 835     | 2017-07-01   | O      |      758 |      0.02% |
| 282  | fortuna3g        | Samsung        | Galaxy Grand Prime (SM-S… | Snapdragon 410     | 2014-10-01   | U      |      754 |      0.02% |
| 283  | hotdog           | OnePlus        | OnePlus 7T Pro            | Snapdragon 855+    | 2019-10-01   | O      |      740 |      0.02% |
| 284  | marlin           | Google         | Pixel XL                  | Snapdragon 821     | 2016-10-01   | O      |      739 |      0.02% |
| 285  | milletwifi       | Samsung        | Galaxy Tab 4 8.0 Wi-Fi    | Snapdragon 400     | 2014-06-01   | U      |      737 |      0.02% |
| 286  | natrium          | Xiaomi         | Mi 5s Plus                | Snapdragon 821     | 2016-10-01   | O      |      731 |      0.02% |
| 287  | x86_64           |                | x86 64bits                | x86_64             |              | U      |      725 |      0.02% |
| 288  | begonia          | Xiaomi         | Redmi Note 8 Pro          | Helio G90T         | 2019-09-01   | U      |      718 |      0.02% |
| 289  | chime            | Xiaomi         | Redmi 9T, Redmi 9 Power,… | Snapdragon 662     | 2021-01-18   | U      |      715 |      0.02% |
| 290  | zeroflte         | Samsung        | Galaxy S6 (SM-G920F)      | Exynos 7420 Octa … | 2015-04-01   | U      |      711 |      0.02% |
| 291  | platina          | Xiaomi         | Mi 8 Lite                 | Snapdragon 660     | 2018-09-01   | D      |      707 |      0.02% |
| 292  | thor             | Xiaomi         | Xiaomi 12S Ultra          | Snapdragon 8+ Gen1 | 2022-07-09   | O      |      702 |      0.02% |
| 293  | sailfish         | Google         | Pixel                     | Snapdragon 821     | 2016-10-01   | O      |      693 |      0.02% |
| 294  | gta4xl           | Samsung        | Galaxy Tab S6 Lite (LTE)  | Exynos 9611        | 2020-04-02   | O      |      688 |      0.02% |
| 295  | rova             | Xiaomi         | Redmi 4A, Redmi 5A        | Snapdragon 425     | 2016-11-01   | U      |      680 |      0.02% |
| 295  | Spacewar         | Nothing        | Phone (1)                 | Snapdragon 778G+ … | 2022-07-12   | O      |      680 |      0.02% |
| 297  | m1721            | Meizu          | M6 Note (m1721)           | Snapdragon 625     | 2017-09-01   | U      |      679 |      0.02% |
| 298  | fogo             | Motorola       | moto g 5G - 2024          | Snapdragon 765G    | 2020-05-01   | O      |      670 |      0.02% |
| 299  | FP5              | Fairphone      | Fairphone 5               | Qualcomm QCM6490   | 2023-08-01   | O      |      667 |      0.02% |
| 300  | j7xelte          | Samsung        | J7 (2016) (J710F)         | Exynos 7870        | 2016-04-01   | U      |      666 |      0.02% |
| 301  | m8               | HTC            | One (M8)                  | Snapdragon 801     | 2014-03-01   | D      |      658 |      0.02% |
| 302  | santoni          | Xiaomi         | Redmi 4(X)                | Snapdragon 435     | 2017-05-01   | D      |      655 |      0.02% |
| 303  | dubai            | Motorola       | edge 30                   | Snapdragon 778G+ … | 2022-05-01   | O      |      654 |      0.02% |
| 304  | caprip           | Motorola       | moto g30, K13 Pro         | Snapdragon 662     | 2021-03-01   | O      |      652 |      0.02% |
| 305  | federer          | Huawei         | MediaPad T2 10.0 Pro      | Snapdragon 615     | 2016-09-01   | U      |      645 |      0.02% |
| 306  | aries            | Xiaomi         | Mi 2                      | Snapdragon S4 Pro  | 2012-11-01   | U      |      641 |      0.01% |
| 307  | munch            | Xiaomi         | POCO F4, Redmi K40S       | Snapdragon 870     | 2022-06-01   | O      |      636 |      0.01% |
| 308  | n1a3g            | Samsung        | Galaxy Note 10.1 (2014) … | Exynos 5420        | 2013-10-01   | U      |      630 |      0.01% |
| 308  | a7xelte          | Samsung        | Galaxy A7 (2016)          | Exynos 7580        | 2015-12-01   | D      |      630 |      0.01% |
| 310  | hermes           | Xiaomi         | Redmi Note 2              | Helio X10          | 2015-08-14   | U      |      628 |      0.01% |
| 311  | falcon           | Motorola       | moto g                    | Snapdragon 400     | 2013-11-01   | D      |      626 |      0.01% |
| 312  | zeroltexx        | Samsung        | Galaxy S6 Edge            | Exynos 7420        | 2015-04-01   | D      |      621 |      0.01% |
| 313  | g0215d           | GREE           | G0215D                    | Snapdragon 820     | 2018-08-01   | U      |      617 |      0.01% |
| 314  | gracerlte        | Samsung        | Galaxy Note FE, Galaxy N… | Exynos 8890 (14nm) | 2016-08-19   | U      |      613 |      0.01% |
| 314  | deb              | Google         | Nexus 7 2013 (LTE)        | Snapdragon S4 Pro  | 2013-07-26   | D      |      613 |      0.01% |
| 316  | rolex            | Xiaomi         | Redmi 4A                  | Snapdragon 425     | 2016-11-01   | U      |      612 |      0.01% |
| 317  | gts28wifi        | Samsung        | Galaxy Tab S2 (8.0”, Wi-… | Exynos 5 Octa 5433 | 2015-09-01   | U      |      609 |      0.01% |
| 318  | golden           | Samsung        | Galaxy S3 Mini, Galaxy S… | NovaThor U8420     | 2012-11-01   | U      |      607 |      0.01% |
| 319  | cancro           | Xiaomi         | Mi 3, Mi 4                | Snapdragon 800     | 2013-10-01   | D      |      600 |      0.01% |
| 320  | cupid            | Xiaomi         | Xiaomi 12                 | Snapdragon 8 Gen1  | 2021-12-31   | O      |      595 |      0.01% |
| 321  | j3xlte           | Samsung        | Galaxy J3 (2016) (SM-J32… | Spreadtrum SC9830A | 2016-05-06   | U      |      593 |      0.01% |
| 322  | i9082            | Samsung        | Galaxy Grand Duos i9082,… | Broadcom BCM28155  | 2013-01-01   | U      |      591 |      0.01% |
| 323  | x86_64_tv_go     |                |                           | x86_64             |              | U      |      590 |      0.01% |
| 324  | cheetah          | Google         | Pixel 7 Pro               | Tensor GS201       | 2022-10-13   | O      |      589 |      0.01% |
| 325  | akita            | Google         | Pixel 8a                  | Tensor G3          | 2023-10-04   | O      |      587 |      0.01% |
| 326  | akari            | Sony           | Xperia XZ2                | Snapdragon 845     | 2018-04-01   | O      |      585 |      0.01% |
| 327  | j3xnlte          | Samsung        | Galaxy J3 (2016) (SM-J32… | Spreadtrum SC9830I | 2016-05-06   | U      |      578 |      0.01% |
| 328  | starfire         | Lenovo         | ThinkSmart View (CD-1878… | Qualcomm APQ8053   | 2020-08-01   | U      |      576 |      0.01% |
| 329  | dre              | OnePlus        | OnePlus Nord N200         | Snapdragon 480     | 2021-06-21   | O      |      575 |      0.01% |
| 330  | odroidn2         | HardKernel     | ODROID-N2                 | Amlogic S922X      | 2019-02-01   | U      |      574 |      0.01% |
| 331  | d2x              | Samsung        | Galaxy Note10+ 5G         | Exynos 9825        | 2019-08-23   | O      |      573 |      0.01% |
| 332  | onyx             | OnePlus        | OnePlus X                 | Snapdragon 801     | 2015-11-01   | D      |      572 |      0.01% |
| 333  | billie           | OnePlus        | OnePlus Nord N10          | Snapdragon 690 5G  | 2020-10-26   | D      |      563 |      0.01% |
| 334  | raven            | Google         | Pixel 6 Pro               | Tensor GS101       | 2021-10-19   | O      |      551 |      0.01% |
| 334  | latte            | Xiaomi         | Mi Pad 2                  | Atom X5-Z8500      | 2015-11-01   | U      |      551 |      0.01% |
| 336  | athene           | Motorola       | moto g4                   | Snapdragon 617     | 2016-05-01   | D      |      541 |      0.01% |
| 337  | salami           | OnePlus        | OnePlus 11 5G             | Snapdragon 8 Gen2  | 2023-01-01   | O      |      540 |      0.01% |
| 338  | perseus          | Xiaomi         | Mi MIX 3                  | Snapdragon 845     | 2018-11-01   | O      |      537 |      0.01% |
| 338  | lt013g           | Samsung        | Galaxy Tab III 8.0 3G, G… | Exynos 4212 Dual   | 2013-07-01   | U      |      537 |      0.01% |
| 340  | twolip           | Xiaomi         | Redmi Note 6 Pro          | Snapdragon 636     | 2018-10-01   | D      |      532 |      0.01% |
| 341  | j2lte            | Samsung        | Galaxy J2 (J200M/F/G/GU/… | Exynos 3475 Quad   | 2015-09-01   | U      |      530 |      0.01% |
| 341  | i9100            | Samsung        | Galaxy S II               | Exynos 4210        | 2011-02-11   | D      |      530 |      0.01% |
| 343  | angelica         | Xiaomi         | Redmi 9C                  | Helio G35 (12 nm)  | 2020-08-12   | U      |      527 |      0.01% |
| 344  | haydn            | Xiaomi         | Mi 11i, Redmi K40 Pro, R… | Snapdragon 888     | 2021-01-01   | O      |      524 |      0.01% |
| 345  | maple_dsds       | Sony           | Xperia XZ Premium Dual S… | Snapdragon 835     | 2017-06-18   | U      |      520 |      0.01% |
| 346  | bach             | Huawei         | MediaPad M3 Lite 8, Medi… | Snapdragon 435     | 2017-06-01   | U      |      519 |      0.01% |
| 347  | j7velte          | Samsung        | Galaxy J7 NXT (J701F)     | Exynos 7870 Octa   | 2017-07-01   | U      |      516 |      0.01% |
| 348  | angler           | Google         | Nexus 6P                  | Snapdragon 810     | 2015-09-29   | D      |      515 |      0.01% |
| 349  | a3y17lte         | Samsung        | Galaxy A3 (2017) (SM-A32… | Exynos 7870 Octa   | 2017-01-01   | U      |      509 |      0.01% |
| 350  | shiba            | Google         | Pixel 8                   | Tensor G3          | 2023-10-04   | O      |      508 |      0.01% |
| 351  | berlin           | Motorola       | edge 20                   | Snapdragon 778G 5G | 2021-07-29   | O      |      503 |      0.01% |
| 352  | millet3g         | Samsung        | Galaxy Tab 4 8.0 3G       | Snapdragon 400     | 2014-06-01   | U      |      501 |      0.01% |
| 353  | jasmine          | ZTE            | AT&T Trek 2 HD            | Snapdragon 617     | 2016-08-01   | D      |      498 |      0.01% |
| 354  | wseries          |                |                           |                    |              | U      |      492 |      0.01% |
| 355  | kuntao           | Lenovo         | P2                        | Snapdragon 625     | 2016-11-01   | D      |      490 |      0.01% |
| 356  | barbet           | Google         | Pixel 5a                  | Snapdragon 765G    | 2021-08-01   | O      |      485 |      0.01% |
| 356  | a3lte            | Samsung        | Galaxy A3 (2015)          | Snapdragon 410     | 2014-12-01   | U      |      485 |      0.01% |
| 358  | s3ve3gjv         | Samsung        | Galaxy S III Neo (Samsun… | Snapdragon 400     | 2014-04-11   | D      |      484 |      0.01% |
| 359  | gts28ltexx       | Samsung        | Galaxy Tab S2 9.7 G3/LTE… | Exynos 5433        | 2015-09-01   | U      |      482 |      0.01% |
| 359  | cmi              | Xiaomi         | Mi 10 Pro                 | Snapdragon 865     | 2020-02-01   | O      |      482 |      0.01% |
| 361  | pdx206           | Sony           | Xperia 5 II               | Snapdragon 865     | 2020-09-01   | O      |      481 |      0.01% |
| 362  | x103f            | Lenovo         | Tab 10, Tab3 10 (TB-X103… | Snapdragon 210 or… | 2016-06-01   | U      |      480 |      0.01% |
| 363  | cereus           | Xiaomi         | Redmi 6                   | Helio P22 (12 nm)  | 2018-06-01   | U      |      478 |      0.01% |
| 364  | zerolte          | Samsung        | Galaxy S6 Edge (SM-G925F) | Exynos 7420 Octa   | 2015-04-10   | U      |      475 |      0.01% |
| 364  | ugglite          | Xiaomi         | Redmi Y1, Redmi Note 5A,… | Snapdragon 435     | 2017-08-21   | U      |      475 |      0.01% |
| 366  | pdx215           | Sony           | Xperia 1 III              | Snapdragon 888     | 2021-04-01   | O      |      470 |      0.01% |
| 367  | t0lte            | Samsung        | Galaxy Note 2 (LTE)       | Exynos 4412        | 2012-09-01   | D      |      469 |      0.01% |
| 368  | jfvelte          | Samsung        | Galaxy S4 Value Edition … | Snapdragon 600     | 2014-04-01   | D      |      467 |      0.01% |
| 369  | serrano3gxx      | Samsung        | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |      464 |      0.01% |
| 370  | gts210velte      | Samsung        | Galaxy Tab S2 9.7 LTE (S… | Snapdragon 652     | 2015-09-01   | U      |      462 |      0.01% |
| 371  | mondrian         | Xiaomi         | POCO F5 Pro, Redmi K60    | Snapdragon 8+ Gen1 | 2022-12-27   | O      |      460 |      0.01% |
| 371  | a505f            | Samsung        | Galaxy A50                | Exynos 9610        | 2019-03-18   | U      |      460 |      0.01% |
| 373  | topaz            | Xiaomi         | Redmi Note 12 4G, Redmi … | Snapdragon 685     | 2023-03-01   | U      |      459 |      0.01% |
| 374  | dodge            | OnePlus        | 13                        | Snapdragon 8 Elite | 2024-11-01   | O      |      457 |      0.01% |
| 375  | x1s              | Samsung        | Galaxy S20, Galaxy S20 5G | Exynos 990         | 2020-03-06   | O      |      456 |      0.01% |
| 376  | waffle           | OnePlus        | OnePlus 12                | Snapdragon 8 Gen3  | 2023-12-01   | O      |      455 |      0.01% |
| 377  | ks01ltexx        | Samsung        | Galaxy S4 LTE-A (GT-I950… | Snapdragon 800     | 2013-10-01   | U      |      451 |      0.01% |
| 378  | foster           | NVIDIA         | Shield TV (2015 / 2015 P… | Tegra X1 (T210)    | 2015-05-28   | O      |      449 |      0.01% |
| 379  | s3ve3gds         | Samsung        | Galaxy S III Neo (Dual S… | Snapdragon 400     | 2014-04-11   | D      |      448 |      0.01% |
| 380  | fleur            | Xiaomi         | Redmi Note 11S, POCO M4 … | Helio G96 (12 nm)  | 2022-02-09   | U      |      447 |      0.01% |
| 381  | gta2xlwifi       | Samsung        | Galaxy Tab A 10.5 (2018)… | Snapdragon 450     | 2018-08-01   | U      |      445 |      0.01% |
| 382  | serranodsdd      | Samsung        | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |      444 |      0.01% |
| 382  | pdx203           | Sony           | Xperia 1 II               | Snapdragon 865     | 2020-05-01   | O      |      444 |      0.01% |
| 382  | flashlmdd        | LG             | V50 ThinQ                 | Snapdragon 855     | 2019-02-01   | D      |      444 |      0.01% |
| 385  | ingres           | Xiaomi         | Poco F4 GT, Redmi K50 Ga… | Snapdragon 8 Gen 1 | 2022-04-28   | U      |      443 |      0.01% |
| 385  | gts7lwifi        | Samsung        | Galaxy Tab S7 (Wi-Fi)     | Snapdragon 865+    | 2020-08-21   | O      |      443 |      0.01% |
| 387  | ido              | Xiaomi         | Redmi 3, Redmi 3 Prime    | Snapdragon 616     | 2016-01-01   | D      |      440 |      0.01% |
| 388  | hulkbuster       |                |                           |                    |              | U      |      439 |      0.01% |
| 389  | aura             | Razer          | Phone 2                   | Snapdragon 845     | 2018-10-01   | O      |      437 |      0.01% |
| 390  | kyleproxx        | Samsung        | Galaxy S Duos 2           | Broadcom BCM 2814… | 2013-12-01   | U      |      435 |      0.01% |
| 391  | nio              | Motorola       | edge s, moto g100         | Snapdragon 870     | 2021-02-01   | O      |      434 |      0.01% |
| 391  | equuleus         | Xiaomi         | Mi 8 Pro                  | Snapdragon 845     | 2018-09-01   | O      |      434 |      0.01% |
| 393  | d1x              | Samsung        | Galaxy Note10 5G          | Exynos 9825        | 2019-08-23   | O      |      432 |      0.01% |
| 394  | garnet           | Xiaomi         | Redmi Note13 Pro 5G, Poc… | Snapdragon 7s Gen… | 2023-09-26   | U      |      431 |      0.01% |
| 395  | sheldon          | Amazon         | Fire TV Stick Lite, Fire… | MediaTek MT8695D   | 2020-09-30   | U      |      430 |      0.01% |
| 396  | raphael          | Xiaomi         | Redmi K20 Pro, Mi 9T Pro  | Snapdragon 855     | 2019-08-20   | U      |      429 |      0.01% |
| 397  | husky            | Google         | Pixel 8 Pro               | Tensor G3          | 2023-10-04   | O      |      426 |     0.010% |
| 397  | akatsuki         | Sony           | Xperia XZ3                | Snapdragon 845     | 2018-10-01   | O      |      426 |     0.010% |
| 399  | kirin            | Sony           | Xperia 10                 | Snapdragon 630     | 2019-02-01   | O      |      425 |     0.010% |
| 400  | xpeng            | Motorola       | moto g200 5G, Edge S30    | Snapdragon 888+    | 2021-11-01   | O      |      423 |     0.010% |
| 401  | cannon           | Xiaomi         | Redmi Note 9 5G, Redmi N… | Dimensity 800U     | 2020-12-01   | U      |      422 |     0.010% |
| 402  | mh2lm            | LG             | G8X ThinQ (G850EM/EMW), … | Snapdragon 855     | 2019-06-01   | D      |      420 |     0.010% |
| 403  | m7               | HTC            | One (GSM)                 | Snapdragon 600     | 2013-03-01   | D      |      414 |     0.010% |
| 404  | hawao            | Motorola       | moto g42                  | Snapdragon 680 4G  | 2022-06-01   | O      |      413 |     0.010% |
| 404  | gtanotexllte     | Samsung        | Galaxy Tab A 10.1 (2016)… | Exynos 7870 Octa   | 2016-05-01   | U      |      413 |     0.010% |
| 406  | Mi439_4_19       | Xiaomi         | Redmi 8A                  | Snapdragon 439     | 2019-10-01   | U      |      412 |     0.010% |
| 407  | kugo             | Sony           | Xperia X Compact          | Snapdragon 650     | 2016-09-08   | D      |      408 |     0.010% |
| 407  | d1               | Samsung        | Galaxy Note10             | Exynos 9825        | 2019-08-23   | O      |      408 |     0.010% |
| 409  | j5nlte           | Samsung        | Galaxy J5 (2015) (SM-J50… | Snapdragon 410     | 2015-07-28   | U      |      405 |     0.009% |
| 409  | TB8704           | Lenovo         | Tab 4 8 Plus (Wi-Fi)      | Snapdragon 625     | 2017-07-01   | U      |      405 |     0.009% |
| 411  | tucana           | Xiaomi         | Mi Note 10, Mi Note 10 P… | Snapdragon 730G    | 2019-11-11   | O      |      403 |     0.009% |
| 412  | selene           | Xiaomi         | Redmi 10                  | Helio G88          | 2021-08-20   | U      |      402 |     0.009% |
| 412  | lt033g           | Samsung        | Galaxy Note 10.1 2014 Ed… | Exynos 5420        | 2013-10-10   | U      |      402 |     0.009% |
| 414  | oxygen           | Xiaomi         | Mi Max 2                  | Snapdragon 625     | 2017-06-01   | U      |      401 |     0.009% |
| 414  | j7y17lte         | Samsung        | Galaxy J7 Pro             | Exynos 7870 Octa   | 2017-07-01   | U      |      401 |     0.009% |
| 414  | R9s              | OPPO           | R9s, R9sk                 | Snapdragon 625     | 2016-10-01   | U      |      401 |     0.009% |
| 417  | fuxi             | Xiaomi         | Xiaomi 13                 | Snapdragon 8 Gen2  | 2022-12-11   | O      |      396 |     0.009% |
| 417  | a72q             | Samsung        | Galaxy A72                | Snapdragon 720G    | 2021-03-26   | O      |      396 |     0.009% |
| 419  | grouper          | ASUS           | Nexus 7 2012              | Tegra 3            | 2012-07-01   | U      |      395 |     0.009% |
| 420  | camellia         | Xiaomi         | Redmi Note 10T, Redmi No… | Dimensity 700      | 2021-07-26   | U      |      393 |     0.009% |
| 421  | zenlte           | Samsung        | Galaxy S6 Edge+           | Exynos 7420 Octa   | 2015-08-01   | U      |      391 |     0.009% |
| 422  | trelteskt        | Samsung        | Galaxy Note 4 (N910S/L/K) | Snapdragon 805     | 2014-10-01   | U      |      385 |     0.009% |
| 423  | Pong             | Nothing        | Phone (2)                 | Snapdragon 8+ Gen1 | 2023-07-11   | O      |      384 |     0.009% |
| 424  | waydroid_arm64_… | virtual        | Waydroid ARM64            | ARM64              |              | U      |      383 |     0.009% |
| 424  | stone            | Xiaomi         | Redmi Note 12, Redmi Not… | Snapdragon 4 Gen 1 | 2023-01-11   | U      |      383 |     0.009% |
| 424  | capricorn        | Xiaomi         | Mi 5s                     | Snapdragon 821     | 2016-10-01   | D      |      383 |     0.009% |
| 427  | nairo            | Motorola       | moto g 5G plus, moto one… | Snapdragon 662     | 2020-05-01   | O      |      380 |     0.009% |
| 428  | titan            | Motorola       | moto g (2014)             | Snapdragon 400     | 2014-06-01   | D      |      379 |     0.009% |
| 429  | x1q              | Samsung        | Galaxy S20                | Exynos 990         | 2020-03-06   | U      |      377 |     0.009% |
| 430  | judyln           | LG             | G7 ThinQ (G710AWM/EM/EMW… | Snapdragon 845     | 2018-05-02   | O      |      373 |     0.009% |
| 431  | lemonades        | OnePlus        | OnePlus 9R                | Snapdragon 888     | 2021-03-01   | O      |      372 |     0.009% |
| 432  | riva             | Xiaomi         | Redmi 5A                  | Snapdragon 425     | 2017-12-01   | U      |      370 |     0.009% |
| 433  | j53gxx           | Samsung        | Galaxy J5 (2015)          | Snapdragon 410     | 2015-07-28   | U      |      368 |     0.009% |
| 434  | markw            | Xiaomi         | Redmi 4 Prime             | Snapdragon 625     | 2016-11-01   | U      |      367 |     0.009% |
| 435  | zeus             | Xiaomi         | Xiaomi 12 Pro             | Snapdragon 8 Gen1  | 2021-12-31   | O      |      365 |     0.009% |
| 436  | veux             | Xiaomi         | POCO X4 Pro 5G            | Snapdragon 695 5G  | 2022-03-23   | U      |      363 |     0.008% |
| 436  | sumire           | Sony           | Xperia Z5                 | Snapdragon 810     | 2015-09-01   | D      |      363 |     0.008% |
| 436  | cebu             | Motorola       | moto g9 power, K12 Pro    | Snapdragon 662     | 2020-11-01   | O      |      363 |     0.008% |
| 439  | rtwo             | Motorola       | edge 40 pro, moto X40 ed… | Snapdragon 8 Gen2  | 2023-04-01   | O      |      361 |     0.008% |
| 439  | TB8504           | Lenovo         | Tab4 8, Tab 4 8           | Snapdragon 425     | 2017-09-15   | U      |      361 |     0.008% |
| 441  | discovery        | Sony           | Xperia XA2 Ultra          | Snapdragon 630     | 2018-02-01   | O      |      355 |     0.008% |
| 442  | surnia           | Motorola       | moto e LTE (2015)         | Snapdragon 410     | 2015-02-01   | D      |      353 |     0.008% |
| 443  | gt510lte         | Samsung        | Galaxy Tab A 9.7 (SM-T55… | Snapdragon 410     | 2015-05-01   | U      |      352 |     0.008% |
| 444  | pollux_windy     | Sony           | Xperia Tablet Z Wi-Fi     | Snapdragon S4 Pro  | 2013-02-01   | D      |      351 |     0.008% |
| 445  | borneo           | Motorola       | moto g power 2021         | Snapdragon 662     | 2021-01-01   | O      |      350 |     0.008% |
| 446  | DRG              | Nokia          | Nokia 6.1 Plus            | Snapdragon 636     | 2018-08-30   | D      |      348 |     0.008% |
| 447  | wt88047          | Wingtech       | Redmi 2                   | Snapdragon 410     | 2015-01-01   | D      |      346 |     0.008% |
| 447  | mondrianlte      | Samsung        | Galaxy Tab Pro 8.4 LTE (… | Snapdragon 800     | 2014-03-01   | U      |      346 |     0.008% |
| 449  | tangorpro        | Google         | Pixel Tablet              | Tensor GS201       | 2023-06-10   | O      |      344 |     0.008% |
| 450  | s3ve3gxx         | Samsung        | Galaxy S III Neo (Sony C… | Snapdragon 400     | 2014-04-11   | D      |      343 |     0.008% |
| 450  | gt5note10wifi    | Samsung        | Galaxy Tab A 9.7 Wi-Fi (… | Snapdragon 410     | 2015-05-01   | U      |      343 |     0.008% |
| 450  | grandprimeve3g   | Samsung        | Galaxy Grand Prime        | Snapdragon 410     | 2014-10-01   | U      |      343 |     0.008% |
| 453  | zl1              | LeEco          | Le Pro3, Le Pro3 Elite    | Snapdragon 821     | 2016-10-01   | D      |      339 |     0.008% |
| 453  | z2_plus          | ZUK            | Z2 Plus                   | Snapdragon 820     | 2016-06-01   | D      |      339 |     0.008% |
| 455  | castor_windy     | Sony           | Xperia Tablet Z2 Wi-Fi    | Snapdragon 801     | 2014-03-26   | D      |      337 |     0.008% |
| 456  | pdx214           | Sony           | Xperia 5 III              | Snapdragon 888     | 2021-04-01   | O      |      335 |     0.008% |
| 456  | guam             | Motorola       | moto e7 plus, K12         | Snapdragon 460     | 2020-09-16   | O      |      335 |     0.008% |
| 458  | z3tcw            | Sony           | Xperia Z3 Tablet Compact… | Snapdragon 801     | 2014-11-01   | U      |      334 |     0.008% |
| 458  | timelm           | LG             | V60 ThinQ 5G              | Snapdragon 865 5G  | 2020-03-20   | U      |      334 |     0.008% |
| 460  | hltetmo          | Samsung        | Galaxy Note 3 LTE (N900T… | Snapdragon 800     | 2013-09-01   | D      |      333 |     0.008% |
| 461  | kminilte         | Samsung        | Galaxy S5 Mini            | Exynos 3470 Quad   | 2014-07-01   | U      |      330 |     0.008% |
| 462  | v1a3g            | Samsung        | Galaxy Note Pro 12.2      | Exynos 5420 Octa   | 2014-02-01   | U      |      327 |     0.008% |
| 463  | duchamp          | Xiaomi         | Redmi K70E, Poco X6 Pro … | Dimensity 8300 Ul… | 2023-11-29   | U      |      325 |     0.008% |
| 463  | diting           | Xiaomi         | Xiaomi 12T Pro, Redmi K5… | Snapdragon 8+ Gen1 | 2022-08-25   | O      |      325 |     0.008% |
| 463  | RM6785           | Realme         | 6, 6i, 6s, Narzo, 7, Nar… | Mediatek MT6785    | 2020-03-11   | U      |      325 |     0.008% |
| 466  | komodo           | Google         | Pixel 9 Pro XL            | Tensor G4          | 2024-08-22   | O      |      323 |     0.008% |
| 467  | pdx234           | Sony           | Xperia 1 V                | Snapdragon 8 Gen2  | 2023-05-01   | O      |      320 |     0.007% |
| 468  | bardockpro       | BQ             | Aquaris X Pro             | Snapdragon 626     | 2017-06-01   | D      |      319 |     0.007% |
| 469  | karin            | Sony           | Xperia Z4 Tablet LTE      | Snapdragon 810     | 2015-10-01   | D      |      318 |     0.007% |
| 470  | TBX304           | Lenovo         | Tab4 8, Tab4 10 WIFI      | Qualcomm APQ8017   | 2017-07-01   | U      |      313 |     0.007% |
| 471  | hltedcm          | Samsung        | Galaxy Note 3 (Docomo SC… | Snapdragon 800     | 2013-09-01   | U      |      312 |     0.007% |
| 472  | suzuran          | Sony           | Xperia Z5 Compact         | Snapdragon 810     | 2015-10-01   | D      |      311 |     0.007% |
| 473  | hanoip           | Motorola       | Moto G60, Moto G40 Fusion | Snapdragon 732G    | 2021-04-27   | U      |      309 |     0.007% |
| 474  | dragon           | Google         | Pixel C                   | Tegra X1 (T210)    | 2015-12-08   | D      |      308 |     0.007% |
| 474  | Z01R             | ASUS           | Zenfone 5Z (ZS620KL)      | Snapdragon 845     | 2018-06-01   | O      |      308 |     0.007% |
| 476  | miami            | Motorola       | edge 30 neo               | Snapdragon 695     | 2022-10-07   | O      |      307 |     0.007% |
| 477  | phoenix          | Xiaomi         | Redmi K30                 | Snapdragon 730G    | 2019-12-01   | U      |      301 |     0.007% |
| 478  | aston            | OnePlus        | OnePlus 12R, ACE 3        | Snapdragon 8 Gen2  | 2024-01-01   | O      |      299 |     0.007% |
| 479  | spaced           | Realme         | 8i, Narzo 50              | Helio G96 MT6781 … | 2021-09-14   | U      |      296 |     0.007% |
| 480  | beckham          | Motorola       | moto z3 play              | Snapdragon 636     | 2018-06-01   | O      |      295 |     0.007% |
| 480  | a5lte            | Samsung        | Galaxy A5 (A500F)         | Snapdragon 410     | 2014-12-01   | U      |      295 |     0.007% |
| 482  | maple            | Sony           | Xperia XZ Premium         | Snapdragon 835     | 2017-06-18   | U      |      292 |     0.007% |
| 483  | d802             | LG             | G2 (International)        | Snapdragon 800     | 2013-09-12   | D      |      290 |     0.007% |
| 484  | m52xq            | Samsung        | Galaxy M52 5G             | Snapdragon 778G 5G | 2021-10-03   | O      |      288 |     0.007% |
| 485  | castor           | Sony           | Xperia Tablet Z2 LTE      | Snapdragon 801     | 2014-03-26   | D      |      287 |     0.007% |
| 486  | suzu             | Sony           | Xperia X                  | Snapdragon 650     | 2016-05-01   | D      |      286 |     0.007% |
| 486  | martini          | OnePlus        | OnePlus 9RT               | Snapdragon 888     | 2021-10-01   | O      |      286 |     0.007% |
| 488  | YTX703L          | Lenovo         | Yoga Tab 3 Plus LTE       | Snapdragon 652     | 2016-12-01   | D      |      282 |     0.007% |
| 489  | zenfone3         | ASUS           | Zenfone 3                 | Snapdragon 625     | 2016-05-30   | D      |      277 |     0.006% |
| 489  | ocn              | HTC            | U11                       | Snapdragon 835     | 2017-06-10   | U      |      277 |     0.006% |
| 489  | j6lte            | Samsung        | Galaxy J6                 | Exynos 7870        | 2018-05-01   | U      |      277 |     0.006% |
| 492  | v2awifi          | Samsung        | Galaxy Tab Pro 12.2 WiFi  | Exynos 5420 Octa   | 2014-03-01   | U      |      276 |     0.006% |
| 492  | kltekor          | Samsung        | Galaxy S5 LTE (G900K/L/S) | Snapdragon 801     | 2014-04-01   | D      |      276 |     0.006% |
| 494  | gts28velte       | Samsung        | Galaxy Tab S2 8.0 (T719)  | Snapdragon 652     | 2016-07-01   | U      |      274 |     0.006% |
| 495  | a73xq            | Samsung        | Galaxy A73 5G             | Snapdragon 778G 5G | 2022-04-22   | O      |      271 |     0.006% |
| 496  | sunny            | Xiaomi         | Redmi Note 10             | Snapdragon 678     | 2021-03-16   | U      |      270 |     0.006% |
| 497  | sakura           | Xiaomi         | Redmi 6 Pro, Mi A2 Lite   | Snapdragon 625     | 2018-07-01   | U      |      267 |     0.006% |
| 497  | oscaro           | OnePlus        | OnePlus Nord CE 2 Lite 5G | Snapdragon 695     | 2022-04-30   | O      |      267 |     0.006% |
| 497  | lava             | Xiaomi         | Redmi 9, Poco M2          | Helio G80          | 2020-06-10   | U      |      267 |     0.006% |
| 497  | klteduos         | Samsung        | Galaxy S5 LTE Duos (G900… | Snapdragon 801     | 2014-06-01   | D      |      267 |     0.006% |
| 501  | serranovelte     | Samsung        | Galaxy S4 Mini (GT-I9195… | Snapdragon 410     | 2015-06-01   | U      |      265 |     0.006% |
| 502  | pstar            | Motorola       | edge 20 pro               | Snapdragon 870     | 2021-08-01   | O      |      262 |     0.006% |
| 502  | manta            | Google         | Nexus 10                  | Exynos 5250        | 2012-11-13   | D      |      262 |     0.006% |
| 504  | rhodep           | Motorola       | moto g82 5G               | Snapdragon 695     | 2022-06-07   | O      |      260 |     0.006% |
| 504  | picassolte       | Samsung        | Galaxy Tab Pro 10.1 LTE … | Snapdragon 800     | 2014-03-01   | U      |      260 |     0.006% |
| 504  | judypn           | LG             | V40 ThinQ                 | Snapdragon 845     | 2018-10-03   | O      |      260 |     0.006% |
| 507  | hltechn          | Samsung        | Galaxy Note 3 LTE (N9008… | Snapdragon 800     | 2013-09-01   | D      |      256 |     0.006% |
| 508  | santos10lte      | Samsung        | Galaxy Tab 3 10.1 LTE (G… | Atom Z2560         | 2013-07-07   | U      |      254 |     0.006% |
| 508  | nitrogen         | Xiaomi         | Mi MAX 3                  | Snapdragon 636     | 2018-07-01   | U      |      254 |     0.006% |
| 510  | caiman           | Google         | Pixel 9 Pro               | Tensor G4          | 2024-09-09   | O      |      252 |     0.006% |
| 511  | virtio_arm64only | virtual        |                           | ARM64              |              | U      |      249 |     0.006% |
| 511  | shieldtablet     | NVIDIA         | Shield Tablet             | Tegra K1 (T124)    | 2014-07-29   | D      |      249 |     0.006% |
| 513  | milletlte        | Samsung        | Galaxy Tab4 8.0 LTE (SM-… | Snapdragon 400     | 2014-06-01   | U      |      248 |     0.006% |
| 514  | m31              | Samsung        | Galaxy M31                | Exynos 9611        | 2020-03-05   | U      |      247 |     0.006% |
| 515  | dm1q             | Samsung        | Galaxy S23                | Snapdragon 8 Gen 2 | 2023-02-17   | U      |      241 |     0.006% |
| 515  | bardock          | BQ             | Aquaris X                 | Snapdragon 626     | 2017-06-01   | D      |      241 |     0.006% |
| 517  | m23xq            | Samsung        | Galaxy M23, Galaxy F23 5G | Snapdragon 750G 5G | 2022-04-08   | U      |      240 |     0.006% |
| 518  | d855             | LG             | G3 (International)        | Snapdragon 801     | 2014-06-01   | D      |      239 |     0.006% |
| 519  | kiwi             | Huawei         | Honor 5X                  | Snapdragon 616     | 2015-11-01   | D      |      236 |     0.006% |
| 520  | sky              | Xiaomi         | Redmi 12, POCO M6 Pro 5G  | Snapdragon 4 Gen 2 | 2023-08-04   | U      |      235 |     0.005% |
| 521  | z3               | Sony           | Xperia Z3                 | Snapdragon 801     | 2014-09-04   | D      |      234 |     0.005% |
| 522  | ovaltine         | OnePlus        | 10T 5G                    | Snapdragon 8+ Gen… | 2022-08-06   | U      |      233 |     0.005% |
| 523  | racer            | Motorola       | edge                      | Snapdragon 765G    | 2020-05-01   | D      |      230 |     0.005% |
| 524  | alphaplus        | LG             | G8 ThinQ, G8 ThinQ (Kore… | Snapdragon 855     | 2019-02-01   | D      |      229 |     0.005% |
| 524  | a40              | Samsung        | Galaxy A40                | Exynos 7904        | 2019-04-01   | U      |      229 |     0.005% |
| 526  | kltedv           | Samsung        | Galaxy S5 LTE (G900I/P)   | Snapdragon 801     | 2014-04-01   | D      |      228 |     0.005% |
| 527  | pollux           | Sony           | Xperia Tablet Z LTE       | Snapdragon S4 Pro  | 2013-02-01   | D      |      227 |     0.005% |
| 528  | a505fn           | Samsung        | Galaxy A50 (SM-A505FN)    | Exynos 9610        | 2019-03-18   | U      |      226 |     0.005% |
| 529  | n8000_deodexed   | Samsung        | Galaxy Note 10.1 3G (GT-… | Exynos 4412 Quad   | 2012-08-01   | U      |      225 |     0.005% |
| 530  | j5y17lte         | Samsung        | Galaxy J5 (2017) (SM-J53… | Exynos 7870 Octa   | 2017-06-01   | U      |      224 |     0.005% |
| 531  | togari           | Sony           | Xperia Z Ultra            | Snapdragon 800     | 2013-07-01   | U      |      222 |     0.005% |
| 532  | sea              | Xiaomi         | Redmi Note 12S            | Helio G96 (12 nm)  | 2023-04-26   | U      |      221 |     0.005% |
| 532  | oce              | HTC            | U Ultra, Ocean Note       | Snapdragon 821     | 2017-02-21   | U      |      221 |     0.005% |
| 532  | land             | Xiaomi         | Redmi 3S, Redmi 3X        | Snapdragon 430     | 2016-06-01   | D      |      221 |     0.005% |
| 535  | pine             | Xiaomi         | Redmi 7A                  | Snapdragon 439     | 2019-07-04   | U      |      219 |     0.005% |
| 535  | FP2              | Fairphone      | Fairphone 2               | Snapdragon 801     | 2015-12-01   | D      |      219 |     0.005% |
| 537  | r8s              | Samsung        | Galaxy S20 FE (SM-G780F)  | Exynos 990         | 2020-10-02   | U      |      218 |     0.005% |
| 538  | poplar           | Sony           | Xperia XZ1 (G8341)        | Snapdragon 835     | 2017-09-19   | U      |      214 |     0.005% |
| 538  | gvwifi           | Samsung        | Galaxy View WiFi (SM-T67… | Exynos 7580 Octa   | 2015-11-01   | U      |      214 |     0.005% |
| 540  | grandprimevelte  | Samsung        | Galaxy Grand Prime VE LTE | Marvell PXA1908    | 2015-07-29   | U      |      213 |     0.005% |
| 541  | sirius           | Sony           | Xperia Z2                 | Snapdragon 801     | 2014-04-01   | D      |      211 |     0.005% |
| 541  | gt5note10lte     | Samsung        | Galaxy Tab A 9.7 LTE (SM… | Snapdragon 410     | 2015-06-01   | U      |      211 |     0.005% |
| 541  | amami            | Sony           | Xperia Z1 compact         | Snapdragon 800     | 2014-01-01   | U      |      211 |     0.005% |
| 541  | RMX2185          | Realme         | C11                       | Helio G35          | 2020-07-07   | U      |      211 |     0.005% |
| 545  | apollo           | Xiaomi         | Mi 10T 5G, Mi 10T Pro, R… | Snapdragon 865 5G  | 2020-10-13   | U      |      210 |     0.005% |
| 545  | A102             | Micromax       | Canvas Doodle 3 (A102)    | Mediatek MT6572    | 2014-04-01   | U      |      210 |     0.005% |
| 547  | pdx235           | Sony           | Xperia 10 V               | Snapdragon 695     | 2023-06-21   | O      |      209 |     0.005% |
| 548  | xun              | Xiaomi         | Redmi Pad SE              | Snapdragon 680 4G  | 2023-09-01   | U      |      208 |     0.005% |
| 549  | beethoven        | Huawei         | Mediapad M3 8.4           | Kirin 950          | 2016-10-01   | U      |      207 |     0.005% |
| 549  | amar_row_lte     | Lenovo         | Tab M10 HD (2nd Gen)      | Helio P22T         | 2020-11-01   | U      |      207 |     0.005% |
| 549  | addison          | Motorola       | moto z play               | Snapdragon 625     | 2016-09-01   | D      |      207 |     0.005% |
| 549  | TB2-X30L         | Lenovo         | TAB 2 A10-30 (TB2-X30L)   | Snapdragon 210     | 2015-10-29   | U      |      207 |     0.005% |
| 553  | sapphire         | Xiaomi         | Redmi Note 13 4G, Redmi … | Snapdragon 685     | 2024-01-15   | U      |      205 |     0.005% |
| 554  | pipa             | Xiaomi         | Pad 6                     | Snapdragon 870 5G  | 2023-04-18   | U      |      200 |     0.005% |
| 555  | tanzanite        | Xiaomi         | Redmi Note 14 4G          | Helio G99 Ultra    | 2025-01-15   | U      |      198 |     0.005% |
| 555  | mako             | Google         | Nexus 4                   | Snapdragon S4 Pro  | 2012-11-13   | D      |      198 |     0.005% |
| 557  | elish            | Xiaomi         | Pad 5 Pro Wi-Fi           | Snapdragon 870 5G  | 2021-08-10   | U      |      197 |     0.005% |
| 557  | capri            | Motorola       | moto g10, moto g10 power… | Snapdragon 460     | 2021-02-01   | O      |      197 |     0.005% |
| 559  | pdx225           | Sony           | Xperia 10 IV              | Snapdragon 695     | 2022-06-30   | O      |      196 |     0.005% |
| 560  | z3tc             | Sony           | Xperia Z3 Tablet Compact  | Snapdragon 801     | 2014-11-01   | U      |      195 |     0.005% |
| 560  | tundra           | Motorola       | edge 30 fusion            | Snapdragon 888+    | 2022-09-01   | O      |      195 |     0.005% |
| 560  | X00T             | ASUS           | Zenfone Max Pro M1        | Snapdragon 636     | 2018-05-01   | U      |      195 |     0.005% |
| 563  | venus            | Xiaomi         | Mi 11                     | Snapdragon 888 5G  | 2021-01-01   | U      |      193 |     0.005% |
| 563  | btvdl09          | Huawei         | Mediapad M3 8.4 (BTV-DL0… | Kirin 950          | 2016-10-01   | U      |      193 |     0.005% |
| 565  | giulia           | OnePlus        | 13R, Ace 5                | Snapdragon 8 Gen 3 | 2025-01-14   | U      |      192 |     0.004% |
| 566  | NB1              | Nokia          | Nokia 8                   | Snapdragon 835     | 2017-08-16   | O      |      190 |     0.004% |
| 567  | thyme            | Xiaomi         | Mi 10S                    | Snapdragon 870     | 2021-03-01   | O      |      189 |     0.004% |
| 567  | honami           | Sony           | Xperia Z1 (C6903)         | Snapdragon 800     | 2013-09-01   | U      |      189 |     0.004% |
| 567  | griffin          | Motorola       | moto z                    | Snapdragon 820     | 2016-09-01   | D      |      189 |     0.004% |
| 570  | z3c              | Sony           | Xperia Z3 Compact         | Snapdragon 801     | 2014-09-04   | D      |      188 |     0.004% |
| 571  | giza             | Amazon         | Fire HD 8 7/6th gen (KFG… | MediaTek MT8163V/B | 2016-09-21   | U      |      187 |     0.004% |
| 572  | btv              | Huawei         | Mediapad M3 8.4           | Kirin 950          | 2016-10-01   | U      |      186 |     0.004% |
| 573  | js01lte          | Samsung        | Galaxy J (Docomo SC-02F)  | Snapdragon 800     | 2013-12-01   | U      |      185 |     0.004% |
| 574  | nabu             | Xiaomi         | Pad 5                     | Snapdragon 860     | 2021-08-10   | U      |      184 |     0.004% |
| 574  | lux              | Motorola       | moto x play               | Snapdragon 615     | 2015-08-01   | D      |      184 |     0.004% |
| 574  | avalon           | OnePlus        | Nord 4                    | Snapdragon 7+ Gen… | 2024-07-01   | O      |      184 |     0.004% |
| 577  | r9s              | OPPO           | R9s                       | Snapdragon 625     | 2016-10-01   | U      |      183 |     0.004% |
| 578  | tblte            | Samsung        | Galaxy Note Edge (SM-N91… | Snapdragon 805     | 2014-11-01   | U      |      182 |     0.004% |
| 578  | socrates         | Xiaomi         | Redmi K60 Pro             | Snapdragon 8 Gen2  | 2022-12-27   | O      |      182 |     0.004% |
| 580  | curtana          | Xiaomi         | Redmi Note 9S, Redmi Not… | Snapdragon 720G    | 2020-04-30   | U      |      181 |     0.004% |
| 580  | RMX1821          | Realme         | 3 (RMX1821)               | Helio P60          | 2019-03-01   | U      |      181 |     0.004% |
| 582  | rodin            | Xiaomi         | Poco X7 Pro               | Dimensity 8400 Ul… | 2025-01-09   | U      |      180 |     0.004% |
| 582  | cheryl           | Razer          | Phone                     | Snapdragon 835     | 2017-11-01   | O      |      180 |     0.004% |
| 584  | monet            | Xiaomi         | Mi 10 Lite 5G             | Snapdragon 765G    | 2020-05-01   | D      |      178 |     0.004% |
| 585  | quill            | NVIDIA         | Jetson TX2 [Android TV],… | Tegra X2 (T186)    | 2017-03-14   | O      |      175 |     0.004% |
| 586  | z3s              | Samsung        | Galaxy S20 Ultra (5G)     | Exynos 990         | 2020-03-06   | O      |      174 |     0.004% |
| 587  | tapas            | Xiaomi         | Redmi Note 12 4G          | Snapdragon 685     | 2023-03-30   | U      |      173 |     0.004% |
| 587  | erhai            | OnePlus        | OnePlus Pad 2 Pro, OnePl… | Snapdragon 8 Elite | 2025-05-01   | O      |      173 |     0.004% |
| 587  | X01BD            | ASUS           | Zenfone Max Pro M2        | Snapdragon 660     | 2018-12-01   | D      |      173 |     0.004% |
| 590  | degaslte         | Samsung        | Galaxy Tab 4 7.0 LTE, Ga… | Exynos 3470 Quad   | 2014-05-01   | U      |      172 |     0.004% |
| 590  | TB8703N          | Lenovo         | Tab3 8 plus               | Snapdragon 625     | 2017-03-01   | U      |      172 |     0.004% |
| 592  | odin             | Sony           | Xperia ZL                 | Snapdragon S4 Pro  | 2013-03-01   | D      |      171 |     0.004% |
| 593  | vermeer          | Xiaomi         | POCO F6 Pro, Redmi K70    | Snapdragon 8 Gen2  | 2023-11-29   | O      |      170 |     0.004% |
| 593  | poplar_dsds      | Sony           | Xperia XZ1 Dual (F8342)   | Snapdragon 835     | 2017-09-19   | U      |      170 |     0.004% |
| 593  | j1acevelte       | Samsung        | Galaxy J1 Ace VE, Galaxy… | Spreadtrum SC9830  | 2016-07-11   | U      |      170 |     0.004% |
| 593  | i9305            | Samsung        | Galaxy S III (LTE / Inte… | Exynos 4412        | 2012-10-01   | D      |      170 |     0.004% |
| 597  | gts7l            | Samsung        | Galaxy Tab S7 (LTE)       | Snapdragon 865+    | 2020-08-21   | O      |      169 |     0.004% |
| 597  | ariel            | Amazon         | Fire HD 6/7               | MediaTek MT8135V   | 2014-10-02   | U      |      169 |     0.004% |
| 599  | chopin           | Xiaomi         | Redmi Note 10 PRO 5G      | Snapdragon 732G    | 2021-03-24   | U      |      168 |     0.004% |
| 600  | tre3calteskt     | Samsung        | Galaxy Note 4 (N916S/L/K) | Exynos 5433        | 2014-10-01   | U      |      167 |     0.004% |
| 600  | odroidxu3        | HardKernel     | ODROID-XU3                | Exynos 5422        | 2014-08-18   | U      |      167 |     0.004% |
| 602  | pme              | HTC            | HTC 10                    | Snapdragon 820     | 2016-05-01   | D      |      165 |     0.004% |
| 603  | odroidc4         | HardKernel     | ODROID-C4 (Android TV)    | Amlogic S905X3     | 2020-12-01   | O      |      164 |     0.004% |
| 603  | mermaid          | Sony           | Xperia 10 Plus            | Snapdragon 636     | 2019-02-01   | O      |      164 |     0.004% |
| 605  | meliusltexx      | Samsung        | Galaxy Mega 6.3           | Snapdragon 400     | 2013-06-01   | U      |      162 |     0.004% |
| 605  | a53x             | Samsung        | Galaxy A53 5G             | Exynos 1280 (5 nm) | 2022-03-24   | U      |      162 |     0.004% |
| 607  | sake             | ASUS           | ZenFone 8                 | Snapdragon 888     | 2021-05-01   | O      |      161 |     0.004% |
| 607  | gt58ltebmc       | Samsung        | Galaxy Tab A 8.0 (SM-T35… | Snapdragon 410     | 2015-05-01   | U      |      161 |     0.004% |
| 609  | pro1x            | F(x)tec        | Pro¹ X                    | Snapdragon 662     | 2022-12-01   | O      |      160 |     0.004% |
| 609  | crackling        | Wileyfox       | Swift                     | Snapdragon 410     | 2015-10-01   | D      |      160 |     0.004% |
| 611  | vili             | Xiaomi         | 11T Pro                   | Snapdragon 888 5G  | 2021-10-05   | U      |      159 |     0.004% |
| 611  | v500             | LG             | G Pad 8.3                 | Snapdragon 600     | 2013-10-14   | D      |      159 |     0.004% |
| 613  | xaga             | Xiaomi         | POCO X4 GT                | Dimensity 8100     | 2022-06-27   | U      |      158 |     0.004% |
| 614  | victara          | Motorola       | moto x (2014)             | Snapdragon 801     | 2014-09-26   | D      |      157 |     0.004% |
| 614  | r5x              | Realme         | 5, 5i, 5s, 5NFC           | Snapdragon 665 SD… | 2019-08-01   | U      |      157 |     0.004% |
| 616  | f62              | Samsung        | Galaxy F62, Galaxy M62    | Exynos 9825        | 2021-02-22   | O      |      156 |     0.004% |
| 616  | a5ultexx         | Samsung        | Galaxy A5 (A500FU)        | Snapdragon 410     | 2014-12-01   | U      |      156 |     0.004% |
| 618  | j1xlte           | Samsung        | Galaxy J1 (2016) (SM-J12… | Spreadtrum SC9830  | 2016-01-01   | U      |      155 |     0.004% |
| 619  | sweet2           | Xiaomi         | Redmi Note 12 Pro         | Dimensity 1080     | 2022-11-01   | U      |      154 |     0.004% |
| 619  | hima             | HTC            | One M9                    | Snapdragon 810     | 2015-03-09   | U      |      154 |     0.004% |
| 621  | flounder         | Google         | Nexus 9 (Wi-Fi)           | Tegra K1 (T124)    | 2014-11-03   | D      |      153 |     0.004% |
| 622  | courbet          | Xiaomi         | Mi 11 Lite 4G             | Snapdragon 732G    | 2021-04-16   | U      |      152 |     0.004% |
| 623  | vivalto3mveml3g  | Samsung        | Galaxy Ace 4 Neo (SM-G31… | Spreadtrum SC8830  | 2014-08-01   | U      |      151 |     0.004% |
| 623  | kagura           | Sony           | Xperia XZ Dual (F8332)    | Snapdragon 820     | 2016-10-03   | U      |      151 |     0.004% |
| 623  | a05m             | Samsung        | A05 (SM-A055F/M)          | Helio G85 (12 nm)  | 2023-10-15   | U      |      151 |     0.004% |
| 623  | RMX1931          | Realme         | X2 Pro (RMX1931)          | Snapdragon 855+    | 2019-10-01   | U      |      151 |     0.004% |
| 627  | ss2              | Sharp          | Aquos S2                  | Snapdragon 630 an… | 2017-08-01   | U      |      150 |     0.004% |
| 627  | milanf           | Motorola       | moto g stylus 5G (2022)   | Snapdragon 695     | 2022-04-27   | O      |      150 |     0.004% |
| 627  | crown            | Samsung        | Galaxy J7 Crown (SM-S767… |                    |              | U      |      150 |     0.004% |
| 630  | voyager          | Sony           | Xperia XA2 Plus           | Snapdragon 630     | 2018-07-01   | O      |      148 |     0.003% |
| 630  | karate           | Lenovo         | K6 Power                  | Snapdragon 430     | 2016-11-01   | U      |      148 |     0.003% |
| 632  | o1s              | Samsung        | Galaxy S21 5G (SM-G991B/… | Exynos 2100        | 2021-01-29   | U      |      146 |     0.003% |
| 632  | nuwa             | Xiaomi         | Xiaomi 13 Pro             | Snapdragon 8 Gen2  | 2022-12-11   | O      |      146 |     0.003% |
| 634  | m21              | Samsung        | Galaxy M21                | Exynos 9611        | 2020-03-23   | U      |      145 |     0.003% |
| 635  | p3s              | Samsung        | Galaxy S21 Ultra 5G (SM-… | Exynos 2100        | 2021-01-29   | U      |      143 |     0.003% |
| 636  | j4corelte        | Samsung        | Galaxy J4+                | Snapdragon 425     | 2018-10-01   | U      |      142 |     0.003% |
| 637  | RMX2020          | Realme         | C3                        | Helio G70          | 2020-02-14   | U      |      140 |     0.003% |
| 638  | n7000            | Samsung        | Galaxy Note N7000         | Exynos 4210 Dual   | 2011-10-01   | U      |      139 |     0.003% |
| 638  | hannah           | Motorola       | moto e5 plus (XT1924-6/7… | Snapdragon 435     | 2018-05-01   | D      |      139 |     0.003% |
| 638  | ham              | ZUK            | Z1                        | Snapdragon 801     | 2015-10-14   | D      |      139 |     0.003% |
| 641  | dm3q             | Samsung        | Galaxy S23 Ultra          | Snapdragon 8 Gen 2 | 2023-02-17   | U      |      138 |     0.003% |
| 642  | pdx237           | Sony           | Xperia 5 V                | Snapdragon 8 Gen2  | 2023-09-01   | O      |      137 |     0.003% |
| 642  | B2N              | Nokia          | Nokia 7 plus              | Snapdragon 660     | 2018-04-30   | O      |      137 |     0.003% |
| 644  | yuga             | Sony           | Xperia Z                  | Snapdragon S4 Pro  | 2013-02-01   | D      |      136 |     0.003% |
| 645  | satsuki          | Sony           | Xperia Z5 Premium         | Snapdragon 810     | 2015-11-05   | U      |      135 |     0.003% |
| 646  | foster_tab       | NVIDIA         | Shield TV (2015 / 2015 P… | Tegra X1 (T210)    | 2015-05-28   | O      |      132 |     0.003% |
| 646  | albus            | Motorola       | moto z2 play              | Snapdragon 626     | 2017-06-01   | D      |      132 |     0.003% |
| 648  | kltekdi          | Samsung        | Galaxy S5 LTE (SC-04F/SC… | Snapdragon 801     | 2014-05-01   | D      |      131 |     0.003% |
| 648  | FP6              | Fairphone      | 6                         | Snapdragon 7s Gen… | 2025-06-25   | U      |      131 |     0.003% |
| 650  | q5q              | Samsung        | Galaxy Z Fold 5           | Snapdragon 8 Gen 2 | 2023-08-11   | U      |      130 |     0.003% |
| 650  | a32              | Samsung        | Galaxy A32 4G             | Helio G80 (12 nm)  | 2021-02-25   | U      |      130 |     0.003% |
| 650  | a21snsxx         | Samsung        | Galaxy A21s               | Exynos 850 (8 nm)  | 2020-06-02   | U      |      130 |     0.003% |
| 653  | marmite          | Wileyfox       | Swift 2, Swift 2 Plus, S… | Snapdragon 430     | 2016-11-01   | U      |      129 |     0.003% |
| 654  | ja3gxx           | Samsung        | Galaxy S4 (I9500)         | Exynos 5410 Octa   | 2013-04-01   | U      |      128 |     0.003% |
| 655  | dopinder         | Walmart        | onn. TV Box 4K (2021)     | Amlogic S905Y2     | 2021-06-01   | O      |      127 |     0.003% |
| 656  | h850             | LG             | G5 (International)        | Snapdragon 820     | 2016-02-01   | D      |      126 |     0.003% |
| 656  | a54x             | Samsung        | Galaxy A54 5G             | Exynos 1380        | 2023-03-24   | U      |      126 |     0.003% |
| 656  | P350             | Samsung        | Galaxy Tab A 8" with S P… | Snapdragon 410     | 2015-05-01   | U      |      126 |     0.003% |
| 659  | jactivelte       | Samsung        | Galaxy S4 Active          | Snapdragon 600     | 2013-06-01   | D      |      125 |     0.003% |
| 659  | Z1               |                |                           |                    |              | U      |      125 |     0.003% |
| 661  | viva             | Xiaomi         | Redmi Note 11 Pro 4G      | Helio G96          | 2022-02-18   | U      |      124 |     0.003% |
| 661  | RMP6768          | Realme         | Pad                       | Helio G80          | 2021-09-16   | U      |      124 |     0.003% |
| 663  | bouquet          | Xiaomi         | Redmi Note 6 Pro          | Snapdragon 636     | 2018-10-01   | U      |      122 |     0.003% |
| 663  | TBX304F          | Lenovo         | Tab4 10 WiFi (TB-X304F)   | Qualcomm APQ8017   | 2017-07-01   | U      |      122 |     0.003% |
| 665  | x86_64_tablet    |                |                           | x86_64             |              | U      |      121 |     0.003% |
| 665  | denver           | Motorola       | moto g stylus 5G          | Snapdragon 480     | 2021-06-14   | O      |      121 |     0.003% |
| 667  | f310p            | FEITIAN        | F310 Smart Financial Ter… |                    | 2022-08-13   | U      |      120 |     0.003% |
| 668  | bahamut          | Sony           | Xperia 1, Xperia 5        | Snapdragon 855     | 2019-05-30   | U      |      119 |     0.003% |
| 668  | a3ltexx          | Samsung        | Galaxy A3 (A300F)         | Snapdragon 410     | 2014-12-01   | U      |      119 |     0.003% |
| 670  | n5120            | Samsung        | Galaxy Note 8.0 (LTE)     | Exynos 4412        | 2013-04-01   | D      |      118 |     0.003% |
| 670  | beyond1          | Samsung        | Galaxy S10                | Exynos 9820        | 2019-03-08   | U      |      118 |     0.003% |
| 672  | fire             | Xiaomi         | Redmi 12                  | Helio G88 MT6769H… | 2023-06-15   | U      |      117 |     0.003% |
| 673  | yunluo           | Xiaomi         | Redmi Pad                 | Helio G99          | 2022-10-05   | U      |      116 |     0.003% |
| 673  | tb128fu          | Lenovo         | Xiaoxin Pad 2022 (TB128F… | Snapdragon 680     | 2022-05-01   | U      |      116 |     0.003% |
| 673  | nx659j           | Nubia          | Red Magic 5G (Global), R… | Snapdragon 865     | 2020-03-01   | O      |      116 |     0.003% |
| 673  | lt02ltespr       | Samsung        | Galaxy Tab 3 7.0 LTE      | Snapdragon 400     | 2016-09-01   | D      |      116 |     0.003% |
| 673  | gta2swifi        | Samsung        | Galaxy Tab A WiFi (SM-T3… | Snapdragon 425     | 2017-09-01   | U      |      116 |     0.003% |
| 673  | RMX2001L1        | Realme         | 6, 6i (India), 6s, Narzo  | Helio G90T         | 2020-03-11   | U      |      116 |     0.003% |
| 679  | trhpltexx        | Samsung        | Galaxy Note 4 (N910U)     | Exynos 5 Octa 5433 | 2014-10-01   | U      |      115 |     0.003% |
| 679  | redwood          | Xiaomi         | Poco X5 Pro               | Snapdragon 778G 5G | 2023-02-07   | U      |      115 |     0.003% |
| 679  | b5q              | Samsung        | Galaxy Z Flip 5           | Snapdragon 8 Gen 2 | 2023-08-11   | U      |      115 |     0.003% |
| 679  | RMX1941          | Realme         | C2                        | Helio P22          | 2019-05-01   | U      |      115 |     0.003% |
| 683  | kccat6           | Samsung        | Galaxy S5 Plus            | Snapdragon 805     | 2014-08-21   | D      |      114 |     0.003% |
| 683  | goyavewifi       | Samsung        | Galaxy Tab E 7” (SM-T113… | Spreadtrum SC8830  | 2015-03-01   | U      |      114 |     0.003% |
| 685  | b2q              | Samsung        | Galaxy Z Flip3 5G         | Snapdragon 888 5G  | 2021-08-27   | U      |      113 |     0.003% |
| 686  | toco             | Xiaomi         | Mi Note 10 Lite           | Snapdragon 730G    | 2020-05-09   | U      |      112 |     0.003% |
| 686  | shark            | Xiaomi         | Black Shark               | Snapdragon 845     | 2018-04-01   | O      |      112 |     0.003% |
| 686  | heart            | Lenovo         | Z5 Pro GT                 | Snapdragon 855     | 2019-01-29   | O      |      112 |     0.003% |
| 686  | debx             | Google         | Nexus 7 2013 (LTE, Repar… | Snapdragon S4 Pro  | 2013-07-26   | D      |      112 |     0.003% |
| 690  | s3ve3g           | Samsung        | Galaxy S3 Neo             | Snapdragon 400     | 2014-04-01   | U      |      111 |     0.003% |
| 690  | peregrine        | Motorola       | moto g 4G                 | Snapdragon 400     | 2014-06-01   | D      |      111 |     0.003% |
| 690  | h990             | LG             | V20 (Global)              | Snapdragon 820     | 2016-10-01   | D      |      111 |     0.003% |
| 693  | trlteduos        | Samsung        | Galaxy Note 4             | Snapdragon 805     | 2014-10-01   | U      |      110 |     0.003% |
| 693  | r7               | OPPO           | R7                        | Snapdragon 615     | 2015-05-01   | U      |      110 |     0.003% |
| 693  | ingot            | Solana         | Saga                      | Snapdragon 8+ Gen1 | 2023-05-01   | O      |      110 |     0.003% |
| 696  | unicorn          | Xiaomi         | Xiaomi 12S Pro            | Snapdragon 8+ Gen1 | 2022-07-04   | O      |      109 |     0.003% |
| 697  | fortunave3g      | Samsung        | Galaxy Grand Prime (SM-G… | Snapdragon 410     | 2014-10-01   | U      |      107 |     0.002% |
| 697  | bronco           | Motorola       | ThinkPhone by motorola    | Snapdragon 8+ Gen1 | 2023-01-01   | O      |      107 |     0.002% |
| 699  | g710n            | LG             | G7 ThinQ (G710N)          | Snapdragon 845     | 2018-05-02   | O      |      106 |     0.002% |
| 699  | felix            | Google         | Pixel Fold                | Tensor GS201       | 2023-06-27   | O      |      106 |     0.002% |
| 699  | a04e             | Samsung        | Galaxy A04e               | Helio P35          | 2022-11-07   | U      |      106 |     0.002% |
| 702  | waydroid_kvadra… | virtual        | Waydroid                  | ARM64              |              | U      |      105 |     0.002% |
| 702  | btvw09           | Huawei         | Mediapad M3 8.4 (BTV-W09… | Kirin 950          | 2016-10-01   | U      |      105 |     0.002% |
| 704  | realme_trinket   | Realme         | 5, 5i, 5s, 5 NFC, 5 Viet… | Snapdragon 665     | 2019-08-01   | U      |      104 |     0.002% |
| 704  | RMX1851          | Realme         | Realme 3 Pro              | Snapdragon 710     | 2019-04-29   | D      |      104 |     0.002% |
| 706  | rock             | Iocean         | Rock MT6752               | MediaTek MT6752    |              | U      |      103 |     0.002% |
| 706  | h918             | LG             | V20 (T-Mobile)            | Snapdragon 820     | 2016-10-01   | D      |      103 |     0.002% |
| 706  | gracelte         | Samsung        | Note 7 (SM-N930F)         | Exynos 8890 Octa   | 2016-09-01   | U      |      103 |     0.002% |
| 709  | tetris           | Nothing        | CMF Phone 1               | Dimensity 7300     | 2024-07-09   | U      |      102 |     0.002% |
| 709  | q2q              | Samsung        | Galaxy Z Fold3 5G         | Snapdragon 888 5G… | 2021-08-27   | U      |      102 |     0.002% |
| 709  | gts7xlwifi       | Samsung        | Galaxy Tab S7+ Wifi       | Snapdragon 865 5G+ | 2020-08-21   | U      |      102 |     0.002% |
| 709  | a42xq            | Samsung        | Galaxy A42 5G             | Snapdragon 750 5G  | 2020-11-11   | U      |      102 |     0.002% |
| 713  | p10bio           |                |                           |                    |              | U      |      101 |     0.002% |
| 713  | m1971            | Meizu          | 16s                       | Snapdragon 855     | 2019-04-01   | U      |      101 |     0.002% |
| 713  | a34x             | Samsung        | Galaxy A34 5G             | Dimensity 1080     | 2023-03-24   | U      |      101 |     0.002% |
| 716  | A10-70L          | Lenovo         | Tab 2 LTE (A10-70L)       | Mediatek MT8732    | 2015-04-01   | U      |      100 |     0.002% |
| 717  | xdplus           | GPD            | XD Plus                   | MediaTek MT8176    | 2018-04-01   | U      |       99 |     0.002% |
| 717  | Pacman           | Nothing        | Phone (2a)                | Dimensity 7200 Pro | 2024-03-12   | U      |       99 |     0.002% |
| 717  | Onyx             | OnePlus        | X                         | Snapdragon 801     | 2015-10-29   | U      |       99 |     0.002% |
| 720  | t2s              | Samsung        | Galaxy S21+ 5G (SM-G996B… | Exynos 2100 (5 nm) | 2021-01-29   | U      |       98 |     0.002% |
| 720  | r11s             | OPPO           | R11                       | Snapdragon 660     | 2017-06-01   | U      |       98 |     0.002% |
| 720  | karin_windy      | Sony           | Xperia Z4 Tablet WiFi     | Snapdragon 810     | 2015-10-01   | D      |       98 |     0.002% |
| 720  | h870             | LG             | G6 (EU Unlocked)          | Snapdragon 821     | 2017-02-01   | D      |       98 |     0.002% |
| 720  | dandelion        | Xiaomi         | Redmi 9A                  | Helio G25          | 2020-07-07   | U      |       98 |     0.002% |
| 720  | a03s             | Samsung        | Galaxy A03s               | Helio P35          | 2021-08-18   | U      |       98 |     0.002% |
| 726  | b0q              | Samsung        | Galaxy S22 Ultra          | Snapdragon 8 Gen 1 | 2022-02-25   | U      |       97 |     0.002% |
| 726  | afyonltecan      | Samsung        | Galaxy Core LTE           | Snapdragon 400     | 2014-05-01   | U      |       97 |     0.002% |
| 728  | karatep          | Lenovo         | K6 Note, K6 Plus          | Snapdragon 430     | 2016-12-01   | U      |       96 |     0.002% |
| 729  | ares             | Xiaomi         | POCO X4 GT, Redmi Note 1… | Dimensity 8100     | 2022-05-31   | U      |       95 |     0.002% |
| 730  | treble           |                |                           |                    |              | U      |       94 |     0.002% |
| 730  | gt58lte          | Samsung        | Galaxy Tab A 8.0 (SM-T35… | Snapdragon 410     | 2015-05-01   | U      |       94 |     0.002% |
| 732  | tank             | Amazon         | Fire TV Stick (2nd gen)   | MediaTek MT8127D   | 2016-10-20   | U      |       93 |     0.002% |
| 732  | kansas           | Motorola       | moto g (2025)             | Dimensity 6300 (6… | 2025-01-30   | U      |       93 |     0.002% |
| 732  | e3q              | Samsung        | Galaxy S24 Ultra          | Snapdragon 8 Gen 3 | 2024-01-24   | U      |       93 |     0.002% |
| 735  | oscar            | Realme         | Realme 9 Pro 5G, Realme … | Snapdragon 695     | 2022-02-23   | O      |       92 |     0.002% |
| 735  | X6531            | Infinix        | Hot 50i                   | Helio G81          | 2024-10-01   | U      |       92 |     0.002% |
| 737  | m5               | Banana Pi      | M5 (Android TV)           | Amlogic S905X3     | 2020-12-01   | O      |       91 |     0.002% |
| 737  | dora             | Sony           | Xperia X Performance      | Snapdragon 820     | 2016-07-01   | U      |       91 |     0.002% |
| 737  | berlna           | Motorola       | edge 2021                 | Snapdragon 778G 5G | 2021-08-19   | O      |       91 |     0.002% |
| 737  | aurora           | Sony           | Xperia XZ2 Premium        | Snapdragon 845     | 2018-04-01   | O      |       91 |     0.002% |
| 741  | odroidm1         | HardKernel     | ODROID-M1                 | Rockchip RK3568B2  | 2022-04-03   | U      |       90 |     0.002% |
| 741  | mayfly           | Xiaomi         | Xiaomi 12S                | Snapdragon 8+ Gen1 | 2022-07-01   | O      |       90 |     0.002% |
| 741  | lt01lte          | Samsung        | Galaxy Tab 3 (SM-T315)    | Exynos 4212 Dual   | 2013-07-01   | U      |       90 |     0.002% |
| 741  | huashan          | Sony           | Xperia SP                 | Snapdragon S4 Pro  | 2013-04-01   | D      |       90 |     0.002% |
| 745  | nikel            | Xiaomi         | Redmi Note 4              | Snapdragon 625     | 2017-01-01   | U      |       89 |     0.002% |
| 745  | nashc            | Realme         | 8                         | Helio G95          | 2021-03-25   | U      |       89 |     0.002% |
| 747  | oxford           | Smartisan      | U3 Pro SE                 | Snapdragon 636     | 2018-05-01   | U      |       88 |     0.002% |
| 747  | g710ulm          | LG             | G7 ThinQ (G710ULM/VMX)    | Snapdragon 845     | 2018-05-02   | O      |       88 |     0.002% |
| 747  | axolotl          | SHIFT          | SHIFT6mq                  | Snapdragon 845     | 2020-06-01   | O      |       88 |     0.002% |
| 750  | i9105p           | Samsung        | Galaxy S II Plus (I9105)  | Broadcom BC28155   | 2013-02-01   | U      |       87 |     0.002% |
| 751  | i9152            | Samsung        | Galaxy Mega 5.8 Duos (I9… | Broadcom BCM28155  | 2013-05-01   | U      |       86 |     0.002% |
| 752  | icosa_sr         | Nintendo       | Switch                    | Tegra X1           | 2017-03-03   | U      |       85 |     0.002% |
| 753  | r9q              | Samsung        | Galaxy S21 FE 5G          | Snapdragon 888 5G  | 2022-01-07   | U      |       84 |     0.002% |
| 753  | P024             | ASUS           | ZenPad 8.0 (Z380KL)       | Snapdragon 410     | 2015-07-01   | D      |       84 |     0.002% |
| 753  | Crystal          | Nokia          | 7.1                       | Snapdragon 636     | 2018-10-28   | U      |       84 |     0.002% |
| 756  | x6833b           | Infinix        | Infinix NOTE 30           | Helio G99          | 2023-05-01   | U      |       83 |     0.002% |
| 756  | scorpio          | Xiaomi         | Mi Note 2                 | Snapdragon 821     | 2016-11-01   | D      |       83 |     0.002% |
| 756  | samurai          | Realme         | X2 Pro (RMX1931)          | Snapdragon 855+    | 2019-10-01   | U      |       83 |     0.002% |
| 756  | o7prolte         | Samsung        | Galaxy On7                | Snapdragon 410     | 2015-11-01   | U      |       83 |     0.002% |
| 760  | waydroid_arm     | virtual        | Waydroid on ARM           | ARM32              |              | U      |       82 |     0.002% |
| 760  | sphynx           | Google         | Pixel C                   | Nvidia Tegra X1    | 2015-12-08   | U      |       82 |     0.002% |
| 760  | h910             | LG             | V20 (AT&T)                | Snapdragon 820     | 2016-10-01   | D      |       82 |     0.002% |
| 760  | a13              | Samsung        | A13                       | Exynos 850 (8 nm)  | 2022-03-23   | U      |       82 |     0.002% |
| 760  | a10dd            | Samsung        | A10                       | Exynos 7884        | 2019-03-19   | U      |       82 |     0.002% |
| 765  | pdx201           | Sony           | Xperia 10 II              | Snapdragon 665     | 2020-05-05   | U      |       81 |     0.002% |
| 765  | m307f            | Samsung        | Galaxy M30s               | Exynos 9611        | 2019-10-30   | U      |       81 |     0.002% |
| 765  | lime             | Xiaomi         | Redmi 9T, Redmi 9T NFC, … | Snapdragon 662     | 2021-01-18   | U      |       81 |     0.002% |
| 765  | caihong          | OnePlus        | Pad Pro, Pad 2            | Snapdragon 8 Gen3  | 2024-06-29   | O      |       81 |     0.002% |
| 765  | X01AD            | ASUS           | Zenfone Max M2            | Snapdragon 632     | 2018-12-01   | D      |       81 |     0.002% |
| 770  | x55              | PowKiddy       | X55                       | Rockchip RK3566    | 2023-05-01   | U      |       80 |     0.002% |
| 770  | lithium          | Xiaomi         | Mi MIX                    | Snapdragon 821     | 2016-10-01   | D      |       80 |     0.002% |
| 772  | wt88047x         | Xiaomi         | Redmi 2                   | Snapdragon 410     | 2015-01-01   | U      |       79 |     0.002% |
| 772  | m31s             | Samsung        | Galaxy M31s               | Exynos 9611        | 2020-08-06   | U      |       79 |     0.002% |
| 772  | eqs              | Motorola       | edge 30 ultra             | Snapdragon 8+ Gen1 | 2022-09-01   | O      |       79 |     0.002% |
| 772  | citrus           | Xiaomi         | POCO M3                   | Snapdragon 662     | 2020-11-27   | U      |       79 |     0.002% |
| 776  | asteroids        | Nothing        | Phone (3a)                | Snapdragon 7s Gen… | 2025-03-11   | U      |       78 |     0.002% |
| 777  | nora             | Motorola       | Moto E5, Moto E (5th Gen… | Snapdragon 425     | 2018-05-01   | U      |       77 |     0.002% |
| 777  | mojito           | Xiaomi         | Redmi Note 10             | Snapdragon 678     | 2021-03-16   | U      |       77 |     0.002% |
| 777  | chuwi_vi10plus   | Chuwi          | Vi10 Plus, Hi10 Plus, Hi… | Atom X5 Z8350      | 2016-10-02   | U      |       77 |     0.002% |
| 777  | X6833B           | Infinix        | Note 30 (X6833B)          | Helio G99          | 2023-05-22   | U      |       77 |     0.002% |
| 781  | ursa             | Xiaomi         | Mi 8 Explorer Edition     | Snapdragon 845     | 2018-07-01   | O      |       76 |     0.002% |
| 781  | porg             | NVIDIA         | Jetson Nano [Android TV]… | Tegra X1 (T210)    | 2019-03-18   | O      |       76 |     0.002% |
| 781  | olivelite        | Xiaomi         | Redmi 8A                  | Snapdragon 439     | 2019-09-30   | U      |       76 |     0.002% |
| 781  | axon7            | ZTE            | Axon 7                    | Snapdragon 820     | 2016-06-01   | D      |       76 |     0.002% |
| 785  | wade             | Dynalink       | TV Box 4K (2021)          | Amlogic S905Y2     | 2021-06-01   | O      |       75 |     0.002% |
| 785  | odessa           | Motorola       | Moto G9 Plus              | Snapdragon 730G    | 2020-09-07   | U      |       75 |     0.002% |
| 785  | j23g             | Samsung        | Galaxy J2 (SM-J200H)      | Exynos 3475 Quad   | 2015-09-01   | U      |       75 |     0.002% |
| 785  | everpal          | Xiaomi         | Redmi Note 11T, Redmi 11… | Dimensity 810      | 2021-12-07   | U      |       75 |     0.002% |
| 785  | X6739            | Infinix        | GT 10 Pro                 | Dimensity 8050     | 2023-08-13   | U      |       75 |     0.002% |
| 790  | ether            | Nextbit        | Robin                     | Snapdragon 808     | 2016-02-01   | D      |       74 |     0.002% |
| 790  | a23              | Samsung        | Galaxy A23                | Snapdragon 680 4G  | 2022-03-25   | U      |       74 |     0.002% |
| 790  | RMX1971          | Realme         | 5 Pro, Q                  | Snapdragon 712     | 2019-09-01   | U      |       74 |     0.002% |
| 793  | judyp            | LG             | V35 ThinQ                 | Snapdragon 845     | 2018-05-30   | O      |       73 |     0.002% |
| 793  | g0q              | Samsung        | Galaxy S22 (SM-S9060)     | Snapdragon 8 Gen 1 | 2022-02-25   | U      |       73 |     0.002% |
| 793  | casuarina        | Vsmart         | Joy 3, Joy 3+             | Snapdragon 632     | 2020-02-14   | O      |       73 |     0.002% |
| 793  | a32x             | Samsung        | Galaxy A32 5G             | Dimensity 720      | 2021-01-22   | U      |       73 |     0.002% |
| 793  | a20e             | Samsung        | Galaxy A20e               | Exynos 7884        | 2019-05-01   | U      |       73 |     0.002% |
| 798  | nx595j           | Nubia          | Z17                       | Snapdragon 835     | 2017-06-01   | U      |       72 |     0.002% |
| 798  | mars             | Xiaomi         | Mi 11 Pro                 | Snapdragon 888     | 2021-03-01   | D      |       72 |     0.002% |
| 798  | jd2019           | Lenovo         | Z5s                       | Snapdragon 710     | 2018-12-24   | U      |       72 |     0.002% |
| 798  | d1q              | Samsung        | Galaxy Note 10 (SM-N970U) | Snapdragon 855     | 2019-08-23   | U      |       72 |     0.002% |
| 802  | olives           | Xiaomi         | Redmi 8, Redmi 8A, Redmi… | Snapdragon 439     | 2019-10-12   | U      |       71 |     0.002% |
| 802  | beyond0          | Samsung        | Galaxy S10e               | Exynos 9820        | 2019-03-08   | U      |       71 |     0.002% |
| 802  | a6plte           | Samsung        | Galaxy A6+ (2018)         | Snapdragon 450     | 2018-05-01   | U      |       71 |     0.002% |
| 802  | Dragon           | Google         | Pixel C                   | Nvidia Tegra X1    | 2015-12-08   | U      |       71 |     0.002% |
| 806  | p6800            | Samsung        | Galaxy Tab 7.7 (P6800)    | Exynos 4 Dual 4210 | 2011-12-01   | U      |       70 |     0.002% |
| 807  | wt89536          | YU             | Yureka 2                  | Snapdragon 625     | 2017-09-01   | U      |       69 |     0.002% |
| 807  | star2qltesq      | Samsung        | Galaxy S9+ USA (SM-G965U) | Snapdragon 845     | 2018-03-01   | U      |       69 |     0.002% |
| 807  | nx551j           | Nubia          | M2                        | Snapdragon 625     | 2017-06-01   | U      |       69 |     0.002% |
| 807  | nobleltejv       | Samsung        | Galaxy Note 5 (SM-N920C)  | Exynos 7420 Octa   | 2015-09-01   | U      |       69 |     0.002% |
| 811  | nx611j           | Nubia          | Z18 Mini                  | Snapdragon 660     | 2018-04-01   | D      |       68 |     0.002% |
| 811  | bitra            | Realme         | GT Neo 2                  | Snapdragon 870 5G  | 2021-09-28   | U      |       68 |     0.002% |
| 811  | A6020            | Lenovo         | Vibe K5, Vibe K5 Plus     | Snapdragon 415     | 2016-04-01   | D      |       68 |     0.002% |
| 814  | kyleprods        | Samsung        | Galaxy S Duos 2 (S7582)   | Broadcom BCM21664T | 2013-12-01   | U      |       67 |     0.002% |
| 814  | Daredevil        | Nokia          | 7.2                       | Snapdragon 660     | 2019-09-23   | U      |       67 |     0.002% |
| 816  | zippo            | Lenovo         | Z6 Pro                    | Snapdragon 855     | 2019-09-11   | O      |       66 |     0.002% |
| 816  | sweet_k6a        | Xiaomi         | Redmi Note 12 Pro 4G      | Snapdragon 732G    | 2023-04-11   | U      |       66 |     0.002% |
| 816  | klteactivexx     | Samsung        | Galaxy S5 Active (G870F)  | Snapdragon 801     | 2014-12-01   | D      |       66 |     0.002% |
| 816  | gale             | Xiaomi         | Redmi 13C (4G), Poco C65  | Helio G85          | 2023-11-10   | U      |       66 |     0.002% |
| 816  | beyond1q         | Samsung        | Galaxy S10 (SM-G973U)     | Snapdragon 855     | 2019-03-08   | U      |       66 |     0.002% |
| 816  | alice            | Huawei         | P8 Lite (ALE-L21)         | Kirin 620          | 2015-05-01   | U      |       66 |     0.002% |
| 816  | a50              | Samsung        | Galaxy A50                | Exynos 9610        | 2019-03-18   | U      |       66 |     0.002% |
| 816  | GM9PRO_sprout    | General Mobile | GM9 Pro                   | Snapdragon 660     | 2018-09-01   | U      |       66 |     0.002% |
| 824  | gprimeltexx      | Samsung        | Galaxy Grand Prime (G530… | Snapdragon 410     | 2014-10-01   | U      |       65 |     0.002% |
| 824  | benz             | OnePlus        | OnePlus Nord CE4          | Snapdragon 7 Gen 3 | 2024-04-01   | O      |       65 |     0.002% |
| 824  | amogus_doha      | Motorola       | Moto G8 Plus              | Snapdragon 665     | 2019-10-28   | U      |       65 |     0.002% |
| 827  | ferrari          | Xiaomi         | Mi 4i                     | Snapdragon 615     | 2015-04-01   | U      |       64 |     0.001% |
| 828  | h830             | LG             | G5 (T-Mobile)             | Snapdragon 820     | 2016-02-01   | D      |       63 |     0.001% |
| 828  | gunnar           | OnePlus        | OnePlus Nord N20          | Snapdragon 695     | 2022-04-28   | O      |       63 |     0.001% |
| 830  | y2q              | Samsung        | Galaxy S20+ 5G            | Snapdragon 865 5G  | 2020-03-06   | U      |       62 |     0.001% |
| 830  | on5ltetmo        | Samsung        | Galaxy On5 (SM-G550T)     | Exynos 3475 Quad   | 2015-11-01   | U      |       62 |     0.001% |
| 830  | a9y18qlte        | Samsung        | Galaxy A9 (2018) (SM-A92… | Snapdragon 660     | 2018-11-01   | U      |       62 |     0.001% |
| 830  | RMX1911          | Realme         | 5, 5i, 5s                 | Snapdragon 665     | 2019-09-01   | U      |       62 |     0.001% |
| 834  | ruby             | Xiaomi         | Redmi Note 12 Pro 5G      | Dimensity 1080     | 2022-11-01   | U      |       61 |     0.001% |
| 834  | r5q              | Samsung        | Galaxy S10 Lite           | Snapdragon 855     | 2020-02-03   | U      |       61 |     0.001% |
| 834  | a22x             | Samsung        | Galaxy A22 5G             | Dimensity 700      | 2021-06-24   | U      |       61 |     0.001% |
| 834  | Z00xD            | ASUS           | Zenfone 2 Laser           | Snapdragon 410     | 2015-09-01   | U      |       61 |     0.001% |
| 834  | A001D            | ASUS           | ZenFone Max Shot, ZenFon… | Snapdragon SiP 1   | 2019-03-01   | U      |       61 |     0.001% |
| 839  | j1mini3gxw       | Samsung        | Galaxy J1 mini 3G         | Spreadtrum SC8830  | 2016-03-01   | U      |       60 |     0.001% |
| 839  | condor           | Motorola       | moto e                    | Snapdragon 200     | 2014-05-13   | D      |       60 |     0.001% |
| 839  | a6000            | Lenovo         | A6000, A6000 Plus         | Snapdragon 410     | 2015-01-28   | U      |       60 |     0.001% |
| 842  | tegu             | Google         | Pixel 9a                  | Tensor G4          | 2025-04-10   | O      |       59 |     0.001% |
| 842  | porg_tab         | NVIDIA         | Jetson Nano [Tablet], Je… | Tegra X1 (T210)    | 2019-03-18   | O      |       59 |     0.001% |
| 842  | perry            | Motorola       | Moto E4 (US model)        | Snapdragon 427     | 2017-06-01   | U      |       59 |     0.001% |
| 842  | ks01lte          | Samsung        | Galaxy S4 LTE-A (GT-I950… | Snapdragon 800     | 2013-10-01   | D      |       59 |     0.001% |
| 842  | j7eltexx         | Samsung        | Galaxy J7 (2015) (SM-J70… | Exynos 7580        | 2015-07-16   | U      |       59 |     0.001% |
| 842  | h3gduoschn       | Samsung        | Galaxy Note 3  (SM-N9002) | Snapdragon 800     | 2013-09-01   | U      |       59 |     0.001% |
| 842  | ghost            | Motorola       | moto x                    | Snapdragon S4 Pro  | 2013-08-23   | D      |       59 |     0.001% |
| 842  | cuscoi           | Motorola       | Moto g96 5G, Moto Edge 5… | Snapdragon 7s Gen… | 2024-05-15   | U      |       59 |     0.001% |
| 842  | corfur           | Motorola       | moto g71 5G               | Snapdragon 695 5G  | 2022-01-19   | U      |       59 |     0.001% |
| 842  | clark            | Motorola       | moto x pure edition (201… | Snapdragon 808     | 2015-09-01   | D      |       59 |     0.001% |
| 842  | a13x             | Samsung        | Galaxy A13 5G             | Dimensity 700 5G   | 2021-12-03   | U      |       59 |     0.001% |
| 853  | tate             | Amazon         | Kindle Fire HD 7" (2nd G… | OMAP 4460 HS       | 2012-09-14   | U      |       58 |     0.001% |
| 853  | nx569j           | Nubia          | Z17 Mini                  | Snapdragon 652 or… | 2017-04-01   | U      |       58 |     0.001% |
| 853  | klimtdcm         | Samsung        | Galaxy Tab S 8.4 (SC-03G) | Snapdragon 800     | 2014-07-01   | U      |       58 |     0.001% |
| 853  | kingdom          | Lenovo         | Vibe Z2 Pro               | Snapdragon 801     | 2014-09-01   | D      |       58 |     0.001% |
| 853  | RMX2030          | Realme         | 5i (RMX2030)              | Snapdragon 665     | 2020-01-01   | U      |       58 |     0.001% |
| 858  | quark            | Motorola       | Moto Maxx, Moto Turbo, D… | Snapdragon 805 AP… | 2014-10-01   | U      |       57 |     0.001% |
| 858  | m51              | Samsung        | M51                       | Snapdragon 730G    | 2020-09-11   | U      |       57 |     0.001% |
| 858  | liber            | Motorola       | one fusion+, one fusion+… | Snapdragon 730     | 2020-06-01   | D      |       57 |     0.001% |
| 858  | andromeda        | Xiaomi         | Mi Mix 3 5g               | Snapdragon 855     | 2019-05-01   | U      |       57 |     0.001% |
| 858  | PNX_sprout       | Nokia          | 8.1, X7                   | Snapdragon 710     | 2018-12-05   | U      |       57 |     0.001% |
| 863  | olive            | Xiaomi         | Redmi 8                   | Snapdragon 439     | 2019-10-12   | U      |       56 |     0.001% |
| 863  | aio_otfp         | Lenovo         | Vibe K3 Note              | Mediatek MT6752    | 2015-03-01   | U      |       56 |     0.001% |
| 865  | zorn             | Xiaomi         | Redmi K80, POCO F7 Pro    | Snapdragon 8 Gen 3 | 2024-11-27   | U      |       55 |     0.001% |
| 865  | pocket2          | Retroid        | Pocket 2                  | MediaTek mt6580a   | 2020-08-01   | U      |       55 |     0.001% |
| 867  | picasso          | Xiaomi         | Redmi K30 5G              | Snapdragon 765G 5G | 2020-01-07   | U      |       54 |     0.001% |
| 867  | f300             | LG             | Vu 3 F300L                | Snapdragon 800     | 2013-10-01   | U      |       54 |     0.001% |
| 867  | comet            | Google         | Pixel 9 Pro Fold          | Tensor G4          | 2024-09-04   | O      |       54 |     0.001% |
| 867  | a30s             | Samsung        | Galaxy A30                | Exynos 7904        | 2019-09-11   | U      |       54 |     0.001% |
| 871  | maguro           | Google         | Galaxy Nexus GSM          | OMAP 4460          | 2011-10-01   | D      |       53 |     0.001% |
| 871  | kmini3g          | Samsung        | Galaxy S5 mini Duos       | Snapdragon 400     | 2014-08-01   | U      |       53 |     0.001% |
| 871  | jfltespr         | Samsung        | Galaxy S4 (SCH-R970, SPH… | Snapdragon 600     | 2013-04-01   | D      |       53 |     0.001% |
| 871  | james            | Motorola       | Moto E5 Play, Moto E Pla… | Snapdragon 425 or… | 2018-07-01   | U      |       53 |     0.001% |
| 871  | cupidr           | Xiaomi         | 12                        | Snapdragon 8 Gen 1 | 2021-12-31   | U      |       53 |     0.001% |
| 871  | c1s              | Samsung        | Galaxy Note20 (SM-N980F)  | Exynos 990         | 2020-08-21   | U      |       53 |     0.001% |
| 871  | RMX2151L1        | Realme         | 7 (Asia - RMX2151L1)      | Helio G95          | 2020-09-10   | U      |       53 |     0.001% |
| 878  | lunaa            | Realme         | GT Master Edition         | Snapdragon 778G 5G | 2021-07-30   | U      |       52 |     0.001% |
| 878  | j1x3gxx          | Samsung        | Galaxy J1 Duos (2016) (S… | Spreadtrum SC9830  | 2016-01-01   | U      |       52 |     0.001% |
| 878  | TB8504F          | Lenovo         | Tab 4 8 (WiFi)            | Snapdragon 425     | 2017-09-15   | U      |       52 |     0.001% |
| 878  | LH7n             | TECNO          | Pova 5 (LH7n)             | Helio G99          | 2023-07-01   | U      |       52 |     0.001% |
| 882  | q4q              | Samsung        | Galaxy Z Fold4, Galaxy F… | Snapdragon 8+ Gen… | 2022-08-25   | U      |       51 |     0.001% |
| 882  | pearl            | Xiaomi         | Redmi Note 12T Pro, Redm… | Dimensity 8200 Ul… | 2023-06-01   | U      |       51 |     0.001% |
| 884  | tiare            | Xiaomi         | Redmi GO                  | Snapdragon 425     | 2019-02-01   | U      |       50 |     0.001% |
| 884  | r1q              | Samsung        | Galaxy A80                | Snapdragon 730     | 2019-05-01   | U      |       50 |     0.001% |
| 884  | pro1             | F(x)tec        | Pro¹                      | Snapdragon 835     | 2019-10-01   | O      |       50 |     0.001% |
| 884  | nx523j           | Nubia          | Z11 Max                   | Snapdragon 652     | 2016-06-01   | U      |       50 |     0.001% |
| 884  | enzo             |                |                           |                    |              | U      |       50 |     0.001% |
| 884  | P661N            | Itel           | P55 5G, Power 55 5G       | Dimensity 6080     | 2023-10-05   | U      |       50 |     0.001% |
| 890  | a24              | Samsung        | Galaxy A24 4G             | Helio G99          | 2023-05-05   | U      |       49 |     0.001% |
| 890  | a04              | Samsung        | Galaxy A04                | Helio P35 MT6765   | 2022-10-10   | U      |       49 |     0.001% |
| 892  | malachite        | Xiaomi         | Redmi Note 14 Pro 5G, PO… | Dimensity 7300 Ul… | 2025-01-15   | U      |       48 |     0.001% |
| 892  | logan2g          | Samsung        | Galaxy Star Pro Duos (GT… | Spreadtrum SC6820  | 2013-10-01   | U      |       48 |     0.001% |
| 892  | kltechn          | Samsung        | Galaxy S5 LTE (G9006V/8V) | Snapdragon 801     | 2014-04-01   | D      |       48 |     0.001% |
| 892  | hl3g             | Samsung        | Galaxy Note3 Neo (SM-N75… | Exynos 5260 Hexa   | 2014-02-01   | U      |       48 |     0.001% |
| 892  | beryl            | Xiaomi         | POCO M7 Pro 5G            | Dimensity 7025 Ul… | 2024-12-20   | U      |       48 |     0.001% |
| 892  | a31              | Samsung        | Galaxy A31                | Helio P65          | 2020-04-27   | U      |       48 |     0.001% |
| 892  | RMX1801          | Realme         | Realme 2 Pro              | Snapdragon 660     | 2018-10-11   | D      |       48 |     0.001% |
| 899  | tilapia          | ASUS           | Nexus 7 3G (2012)         | Tegra 3 T30L       | 2012-07-13   | U      |       47 |     0.001% |
| 899  | me173x           | ASUS           | Memo Pad HD7 (MT8125)     | Mediatek MT8125    | 2013-07-01   | U      |       47 |     0.001% |
| 899  | le_x620          | LeEco          | Le 2                      | Helio X20 MT6797   | 2016-04-01   | U      |       47 |     0.001% |
| 899  | k3gxx            | Samsung        | Galaxy S5 (International… | Exynos 5422        | 2014-03-01   | D      |       47 |     0.001% |
| 899  | ef63             | Pantech        | VEGA Iron 2               | Snapdragon 801     | 2014-05-01   | U      |       47 |     0.001% |
| 899  | b4q              | Samsung        | Galaxy Z Flip 4 5G        | Snapdragon 8+ Gen… | 2022-08-25   | U      |       47 |     0.001% |
| 905  | pissarro         | Xiaomi         | Redmi Note 11 Pro, Redmi… | Helio G96          | 2022-02-18   | U      |       46 |     0.001% |
| 905  | m14x             | Samsung        | Galaxy F14                | Exynos 1330        | 2023-03-30   | U      |       46 |     0.001% |
| 905  | hennessy         | Xiaomi         | Redmi Note 3 (mediatek)   | Snapdragon 650     | 2016-03-03   | U      |       46 |     0.001% |
| 905  | h815             | LG             | G4 (International)        | Snapdragon 808     | 2015-06-01   | D      |       46 |     0.001% |
| 909  | thea             | Motorola       | moto g LTE (2014)         | Snapdragon 400     | 2015-01-01   | D      |       45 |     0.001% |
| 909  | jackpot2lte      | Samsung        | Galaxy A8+ 2018           | Exynos 7885        | 2018-01-01   | U      |       45 |     0.001% |
| 909  | e1s              | Samsung        | Galaxy S24 (SM-S921B/N)   | Exynos 2400        | 2024-01-24   | U      |       45 |     0.001% |
| 909  | X6532            | Infinix        | SMART 9 (X6532)           | Helio G81          | 2024-10-01   | U      |       45 |     0.001% |
| 909  | RMX3852          | Realme         | GT Neo6                   | Snapdragon 8s Gen… | 2024-05-09   | U      |       45 |     0.001% |
| 914  | rhannah          | Motorola       | moto e5 plus (XT1924-1/2… | Snapdragon 425     | 2018-05-01   | D      |       44 |     0.001% |
| 914  | mediapadm5lte    | Huawei         | Huawei MediaPad M5 lite   | Kirin 659          | 2018-10-01   | U      |       44 |     0.001% |
| 914  | c2502t_cm8900pl… | C Idea         | CM8900 Plus               | Snapdragon QT615   | 2025-09-24   | U      |       44 |     0.001% |
| 914  | breeze           | Xiaomi         | Poco M6 Plus 5G, Redmi 1… | Snapdragon 4 Gen … | 2024-07-12   | U      |       44 |     0.001% |
| 914  | X3               |                |                           |                    |              | U      |       44 |     0.001% |
| 919  | zeekr            | Motorola       | Razr 40 Ultra             | Snapdragon 8+ Gen… | 2023-06-05   | U      |       43 |     0.001% |
| 919  | radxa0           | Radxa          | Zero (Android TV)         | Amlogic S905Y2     | 2020-12-01   | O      |       43 |     0.001% |
| 919  | psyche           | Xiaomi         | 12X                       | Snapdragon 870 5G  | 2021-12-31   | U      |       43 |     0.001% |
| 919  | kltedcmactive    | Samsung        | Galaxy S5 Active (G870A)  | Snapdragon 801     | 2014-05-01   | U      |       43 |     0.001% |
| 919  | hllte            | Samsung        | Galaxy Note 3 Neo         | Exynos 5260 Hexa   | 2014-02-01   | U      |       43 |     0.001% |
| 919  | denniz           | OnePlus        | Nord 2 5G                 | Dimensity 1200 (6… | 2021-07-28   | U      |       43 |     0.001% |
| 919  | cruiserltesq     | Samsung        | Galaxy S8 Active (SM-G89… | Snapdragon 835     | 2017-08-01   | U      |       43 |     0.001% |
| 926  | m01q             | Samsung        | Galaxy M01                | Snapdragon 439     | 2020-06-02   | U      |       42 |    0.0010% |
| 926  | frd              | Huawei         | Honor 8                   | Kirin 950          | 2016-07-01   | U      |       42 |    0.0010% |
| 926  | betalm           | LG             | G8s ThinQ                 | Snapdragon 855     | 2019-06-01   | D      |       42 |    0.0010% |
| 929  | halo             | Lenovo         | Legion Y70                | Snapdragon 8+ Gen… | 2022-08-23   | U      |       41 |    0.0010% |
| 929  | gprimelte        | Samsung        | Galaxy Grand Prime        | Snapdragon 410     | 2014-10-01   | U      |       41 |    0.0010% |
| 929  | g0s              | Samsung        | Galaxy S22+ 5G (SM-S906B) | Exynos 2200        | 2022-02-25   | U      |       41 |    0.0010% |
| 929  | eyeul            | HTC            | Desire Eye                | Snapdragon 801     | 2014-11-01   | U      |       41 |    0.0010% |
| 929  | a16              | HTC            | Desire 530                | Snapdragon 210     | 2016-03-01   | U      |       41 |    0.0010% |
| 934  | zizhan           | Xiaomi         | MIX Fold 2                | Snapdragon 8+ Gen1 | 2022-08-11   | O      |       40 |    0.0009% |
| 934  | zangyapro        | BQ             | Aquaris X2 Pro            | Snapdragon 626     | 2017-06-01   | D      |       40 |    0.0009% |
| 934  | vela             | Xiaomi         | Mi CC9 Meitu Edition      | Snapdragon 710     | 2019-09-01   | O      |       40 |    0.0009% |
| 934  | parker           | Motorola       | one zoom                  | Snapdragon 675     | 2019-09-05   | D      |       40 |    0.0009% |
| 934  | find7            | OPPO           | Find 7a, Find 7s          | Snapdragon 801     | 2014-03-19   | D      |       40 |    0.0009% |
| 934  | corot            | Xiaomi         | Redmi K60 Ultra           | Dimensity 9200+ (… | 2023-08-15   | U      |       40 |    0.0009% |
| 934  | Amber            | Yandex         | Phone                     | Snapdragon 630     | 2018-12-01   | D      |       40 |    0.0009% |
| 941  | tiro             | Nubia          | Red Magic 9 Pro           | Snapdragon 8 Gen 3 | 2023-11-23   | U      |       39 |    0.0009% |
| 941  | t6               | HTC            | One Max (GSM)             | Snapdragon 600     | 2013-10-01   | D      |       39 |    0.0009% |
| 941  | mi439            | Xiaomi         | Redmi 8A Dual             | Snapdragon 439     | 2019-10-01   | U      |       39 |    0.0009% |
| 941  | a25x             | Samsung        | Galaxy A25 5G             | Exynos 1280        | 2023-12-16   | U      |       39 |    0.0009% |
| 941  | RMX2001          | Realme         | 6                         | Helio G90T (12 nm) | 2020-03-11   | U      |       39 |    0.0009% |
| 941  | RMX1805          | Realme         | 2 Pro                     | Snapdragon 660 (1… | 2018-10-01   | U      |       39 |    0.0009% |
| 941  | MT6893           |                |                           | Dimensity 1200 (M… | 2021-01-19   | U      |       39 |    0.0009% |
| 941  | 2036             |                |                           |                    |              | U      |       39 |    0.0009% |
| 949  | us996            | LG             | V20 (GSM Unlocked)        | Snapdragon 820     | 2016-10-01   | D      |       38 |    0.0009% |
| 949  | kylepro          | Samsung        | Galaxy Trend Plus (GT-S7… | Broadcom BCM21664  | 2013-12-02   | U      |       38 |    0.0009% |
| 949  | a3core           | Samsung        | Galaxy A03 Core           | Unisoc SC9863A (2… | 2021-12-06   | U      |       38 |    0.0009% |
| 949  | a10s             | Samsung        | Galaxy M01s               | Helio P22          | 2020-07-16   | U      |       38 |    0.0009% |
| 949  | Z500             | Acer           | Liquid Z500               | Mediatek MT6582 (… | 2014-09-01   | U      |       38 |    0.0009% |
| 949  | 2027             |                |                           |                    |              | U      |       38 |    0.0009% |
| 955  | zerofltecan      | Samsung        | Galaxy S6 (SM-G920F)      | Exynos 7420 Octa   | 2015-04-01   | U      |       37 |    0.0009% |
| 955  | vs995            | LG             | V20 (Verizon)             | Snapdragon 820     | 2016-10-01   | D      |       37 |    0.0009% |
| 955  | r0s              | Samsung        | Galaxy S22 (SM-S901B)     | Snapdragon 8 Gen 1 | 2022-02-25   | U      |       37 |    0.0009% |
| 955  | lentislte        | Samsung        | Galaxy S5 LTE-A           | Snapdragon 805     | 2014-07-15   | D      |       37 |    0.0009% |
| 955  | charlotte        | Huawei         | P20 Pro                   | Kirin 970          | 2018-04-01   | D      |       37 |    0.0009% |
| 955  | TB2X30L          | Lenovo         | Tab2 A10-30L (TB2-X30L)   | Snapdragon 210     | 2015-09-01   | U      |       37 |    0.0009% |
| 961  | rubens           | Xiaomi         | Redmi K50                 | Dimensity 8100     | 2022-03-22   | U      |       36 |    0.0008% |
| 961  | p6200            | Samsung        | Galaxy Tab 7.0 Plus (GT-… | Exynos 4210        | 2011-10-01   | U      |       36 |    0.0008% |
| 961  | m307fn           | Samsung        | M30s (SM-M307FN)          | Exynos 9611 (10 n… | 2019-10-30   | U      |       36 |    0.0008% |
| 961  | loganreltexx     | Samsung        | Galaxy Ace 3 LTE (S7275)  | Snapdragon 400     | 2013-07-01   | U      |       36 |    0.0008% |
| 961  | a23xq            | Samsung        | Galaxy A23 5G SM-A2360    | Snapdragon 695 5G… | 2022-09-02   | U      |       36 |    0.0008% |
| 961  | a14x             | Samsung        | Galaxy A14 5G             | Exynos 1330        | 2023-01-12   | U      |       36 |    0.0008% |
| 961  | Z00T             | ASUS           | Zenfone 2 Laser (1080p),… | Snapdragon 615     | 2015-11-01   | D      |       36 |    0.0008% |
| 961  | TB3710F          | Lenovo         | Tab 3 710f                | Mediatek MT8161    | 2016-04-01   | U      |       36 |    0.0008% |
| 969  | m30lte           | Samsung        | Galaxy M30                | Exynos 7904 (14 n… | 2019-03-07   | U      |       35 |    0.0008% |
| 969  | fde_x86_64       |                |                           | x86_64             |              | U      |       35 |    0.0008% |
| 969  | eagle            | Sony           | Xperia M2                 | Snapdragon 400 (2… | 2014-05-01   | U      |       35 |    0.0008% |
| 969  | e8               | HTC            | One E8                    | Snapdragon 801 (2… | 2014-06-01   | U      |       35 |    0.0008% |
| 969  | androidbox       |                |                           |                    |              | U      |       35 |    0.0008% |
| 969  | PAN_sprout       | Nokia          | 4.2                       | Snapdragon 439     | 2019-05-07   | U      |       35 |    0.0008% |
| 969  | KL5              | TECNO          | SPARK 30C (KL5)           | Helio G81          | 2024-09-15   | U      |       35 |    0.0008% |
| 976  | ziti             | OnePlus        | Nord CE3                  | Snapdragon 782G (… | 2023-08-05   | U      |       34 |    0.0008% |
| 976  | vns              | Huawei         | P9 Lite, G9 Lite, Honor … | Kirin 650 (16 nm)  | 2016-05-15   | U      |       34 |    0.0008% |
| 976  | star             | Xiaomi         | Mi 11 Ultra               | Snapdragon 888     | 2021-04-01   | U      |       34 |    0.0008% |
| 976  | roth             | NVIDIA         | Shield Portable           | Tegra 4 (T114)     | 2013-07-31   | D      |       34 |    0.0008% |
| 976  | cezanne          | Xiaomi         | Redmi K30 Ultra           | Dimensity 1000+ (… | 2020-08-14   | U      |       34 |    0.0008% |
| 976  | OP4F2F           | OPPO           | A15s                      | Helio P35          | 2020-12-18   | U      |       34 |    0.0008% |
| 976  | ASUS_X00AD_2     | ASUS           | ZenFone Go (ZB500KL)      | Snapdragon 410 (2… | 2016-10-01   | U      |       34 |    0.0008% |
| 983  | venice           | Blackberry     | Priv                      | Snapdragon 808 MS… | 2015-11-01   | U      |       33 |    0.0008% |
| 983  | rubyx            | Xiaomi         | Redmi Note 12 Pro, Pro P… | Dimensity 1080 (6… | 2022-11-01   | U      |       33 |    0.0008% |
| 983  | hiae             | HTC            | One A9                    | Snapdragon 617     | 2015-10-20   | D      |       33 |    0.0008% |
| 983  | a5y17ltecan      | Samsung        | Galaxy A5 (2017) (SM-A52… | Exynos 7880        | 2017-01-01   | U      |       33 |    0.0008% |
| 983  | a13ve            | Samsung        | Galaxy A13 (SM-A137F)     | Helio G80          | 2022-07-01   | U      |       33 |    0.0008% |
| 988  | taoyao           | Xiaomi         | 12 Lite                   | Snapdragon 778G    | 2022-07-11   | U      |       32 |    0.0007% |
| 988  | sltexx           | Samsung        | Galaxy Alpha              | Exynos 5430 Octa   | 2014-09-01   | U      |       32 |    0.0007% |
| 988  | pele             | Huawei         | MediaPad T2 7.0 Pro       | Snapdragon 615 MS… | 2016-09-01   | U      |       32 |    0.0007% |
| 988  | j5xnltexx        | Samsung        | Galaxy J5 (2016)          | Snapdragon 410     | 2015-04-01   | U      |       32 |    0.0007% |
| 988  | bathena          | Motorola       | defy 2021                 | Snapdragon 662     | 2021-06-01   | O      |       32 |    0.0007% |
| 988  | X00P             | ASUS           | Zenfone Max M1            | Snapdragon 430     | 2018-12-01   | D      |       32 |    0.0007% |
| 994  | x3               | Realme         | X3, X3 SuperZoom          | Snapdragon 855+ S… | 2020-06-30   | U      |       31 |    0.0007% |
| 994  | spartan          | Realme         | GT Neo 3T (RMX3371)       | Snapdragon 870 5G… | 2022-06-25   | U      |       31 |    0.0007% |
| 994  | nobleltezt       | Samsung        | Galaxy Note5              | Exynos 7420 Octa   | 2015-08-21   | U      |       31 |    0.0007% |
| 994  | memul            | HTC            | One Mini 2                | Snapdragon 400 (2… | 2014-05-01   | U      |       31 |    0.0007% |
| 994  | j7duolte         | Samsung        | Galaxy J7 Duo (SM-J720F/… | Exynos 7885        | 2018-04-01   | U      |       31 |    0.0007% |
| 994  | gts7xl           | Samsung        | Galaxy Tab S7+, Galaxy T… | Snapdragon 865+    | 2020-08-21   | U      |       31 |    0.0007% |
| 994  | delos3geur       | Samsung        | Galaxy Win, Galaxy Grand… | Snapdragon 200     | 2013-05-01   | U      |       31 |    0.0007% |
| 994  | T00F             | ASUS           | Zenfone 5 (A501CG)        | Atom Z2520         | 2015-01-01   | U      |       31 |    0.0007% |
| 994  | K2               |                |                           |                    |              | U      |       31 |    0.0007% |
| 1003 | l01k             | LG             | V30 (Japan)               | Snapdragon 835     | 2017-08-01   | O      |       30 |    0.0007% |
| 1003 | h872             | LG             | G6 (T-Mobile)             | Snapdragon 821     | 2017-02-01   | D      |       30 |    0.0007% |
| 1003 | e8d              | HTC            | One E8 (dual SIM)         | Snapdragon 801 (2… | 2014-06-01   | U      |       30 |    0.0007% |
| 1003 | a55x             | Samsung        | Galaxy A55 5G             | Exynos 1480        | 2024-03-01   | U      |       30 |    0.0007% |
| 1003 | a3xeltexx        | Samsung        | Galaxy A3 (2016)          | Exynos 7578        | 2015-12-01   | U      |       30 |    0.0007% |
| 1003 | TB3-850M         | Lenovo         | Tab3 8                    | Mediatek MT8161 (… | 2016-06-01   | U      |       30 |    0.0007% |
| 1009 | wt86528          | Lenovo         | A6010, K31-t3, wt86528    | Snapdragon 410     | 2015-10-01   | U      |       29 |    0.0007% |
| 1009 | j2xlte           | Samsung        | J2 (2016)                 | Spreadtrum SC8830  | 2016-07-01   | U      |       29 |    0.0007% |
| 1009 | ivy              | Sony           | Xperia Z3+                | Snapdragon 810     | 2015-06-01   | D      |       29 |    0.0007% |
| 1009 | e53g             | Samsung        | Galaxy E5 (SM-E500H)      | Snapdragon 410 (M… | 2015-02-01   | U      |       29 |    0.0007% |
| 1009 | beyond2          | Samsung        | Galaxy S10+ (SM-G975F)    | Exynos 9820 Octa   | 2019-03-08   | U      |       29 |    0.0007% |
| 1009 | a5dwg            | HTC            | Desire 816 dual SIM       | Snapdragon 400 (2… | 2014-05-01   | U      |       29 |    0.0007% |
| 1015 | star2qltecs      | Samsung        | Galaxy S9+ (SM-G965W)     | Snapdragon 845     | 2018-03-01   | U      |       28 |    0.0007% |
| 1015 | nx606j           | Nubia          | Z18                       | Snapdragon 845     | 2018-09-01   | O      |       28 |    0.0007% |
| 1015 | m2note           | Meizu          | M2 Note, Blue Charm Note2 | Mediatek MT6753 (… | 2015-06-01   | U      |       28 |    0.0007% |
| 1015 | ef59             | Pantech        | VEGA Secret Note          | Snapdragon 800 (M… | 2013-10-01   | U      |       28 |    0.0007% |
| 1015 | dream2qltesq     | Samsung        | Galaxy S8+ (SM-G955U)     | Snapdragon 835     | 2017-04-01   | U      |       28 |    0.0007% |
| 1015 | d2att            | Samsung        | Galaxy S III (AT&T)       | Snapdragon S4 Plus | 2012-06-28   | D      |       28 |    0.0007% |
| 1015 | atom             | Xiaomi         | Redmi 10X (atom, M2004J7… | Dimensity 820      | 2020-05-01   | U      |       28 |    0.0007% |
| 1022 | w7               | LG             | L90                       | Snapdragon 400     | 2014-02-01   | D      |       27 |    0.0006% |
| 1022 | scale            |                |                           |                    |              | U      |       27 |    0.0006% |
| 1022 | r0q              | Samsung        | Galaxy S22 5G             | Snapdragon 8 Gen 1 | 2022-02-25   | U      |       27 |    0.0006% |
| 1022 | ms01lte          | Samsung        | Galaxy Grand2             | Snapdragon 400 MS… | 2013-12-01   | U      |       27 |    0.0006% |
| 1022 | g2m              | LG             | G2 Mini                   | Snapdragon 400     | 2014-04-01   | D      |       27 |    0.0006% |
| 1022 | c2q              | Samsung        | Galaxy Note20 Ultra 5G    | Snapdragon 865+    | 2020-08-21   | U      |       27 |    0.0006% |
| 1022 | 2026             |                |                           |                    |              | U      |       27 |    0.0006% |
| 1029 | starqltesq       | Samsung        | Galaxy S9 (SM-G960U)      | Snapdragon 845     | 2018-03-09   | U      |       26 |    0.0006% |
| 1029 | starqltecs       | Samsung        | Galaxy S9 (SM-G960W)      | Snapdragon 845 (1… | 2018-03-09   | U      |       26 |    0.0006% |
| 1029 | nx591j           | ZTE            | Z17 Lite (NX591J)         | Snapdragon 653     | 2017-04-01   | U      |       26 |    0.0006% |
| 1029 | j5ltechn         | Samsung        | Galaxy J5 (SM-J5008)      | Snapdragon 410     | 2015-06-01   | U      |       26 |    0.0006% |
| 1029 | greatqlte        | Samsung        | Galaxy Note8 (SM-N9500)   | Snapdragon 835     | 2017-09-01   | U      |       26 |    0.0006% |
| 1029 | dm2q             | Samsung        | Galaxy S23+ (SM-S9160)    | Snapdragon 8 Gen … | 2023-02-01   | U      |       26 |    0.0006% |
| 1029 | bloomq           | Samsung        | Galaxy Z Flip             | Snapdragon 855+    | 2020-02-14   | U      |       26 |    0.0006% |
| 1029 | arubaslim        | Samsung        | Galaxy Core (GT-I8262)    | Snapdragon S4 Pla… | 2013-05-01   | U      |       26 |    0.0006% |
| 1029 | alphalm          | LG             | G8 ThinQ (LM-G820)        | Snapdragon 855     | 2019-04-11   | U      |       26 |    0.0006% |
| 1029 | Z00L             | ASUS           | Zenfone 2 Laser (720p)    | Snapdragon 410     | 2015-11-01   | D      |       26 |    0.0006% |
| 1029 | Z00A             | ASUS           | Zenfone 2 (1080p)         | Atom Z3580         | 2015-03-01   | D      |       26 |    0.0006% |
| 1040 | z3q              | Samsung        | Galaxy S20 Ultra 5G       | Snapdragon 865 5G  | 2020-03-06   | U      |       25 |    0.0006% |
| 1040 | z2_row           | ZUK            | Z2 Pro                    | Snapdragon 820     | 2016-06-01   | U      |       25 |    0.0006% |
| 1040 | star2lteks       | Samsung        | Galaxy S9+ (SM-G965N)     | Exynos 9 Octa 981… | 2018-03-01   | U      |       25 |    0.0006% |
| 1040 | porsche          | Realme         | GT 2                      | Snapdragon 888 5G  | 2022-01-04   | U      |       25 |    0.0006% |
| 1040 | paella           | BQ             | Aquaris X5                | Snapdragon 412     | 2015-10-14   | D      |       25 |    0.0006% |
| 1040 | lexus            | OnePlus        | Nord 5                    | Snapdragon 8s Gen… | 2025-07-08   | U      |       25 |    0.0006% |
| 1040 | jag3gds          | LG             | G3 S                      | Snapdragon 400     | 2014-08-01   | D      |       25 |    0.0006% |
| 1040 | certus64         | Xiaomi         | Redmi 6, Redm 6A          | Helio P22 MT6762   | 2018-06-01   | U      |       25 |    0.0006% |
| 1048 | hi6250           | Huawei         | P9 Lite                   | Kirin 650          | 2016-04-20   | U      |       24 |    0.0006% |
| 1048 | hero2ltektt      | Samsung        | Galaxy S7 Edge (SM-G935K) | Exynos 8 Octa 889… | 2016-03-11   | U      |       24 |    0.0006% |
| 1048 | ef60             | Pantech        | VEGA Secret UP (EF60S)    | Snapdragon 800     | 2013-12-01   | U      |       24 |    0.0006% |
| 1048 | cherry           | Huawei         | Honor 4, Honor 4X         | Snapdragon 410 (M… | 2014-10-01   | D      |       24 |    0.0006% |
| 1048 | a20s             | Samsung        | Galaxy A20s               | Snapdragon 450     | 2019-10-05   | U      |       24 |    0.0006% |
| 1048 | OP4863           | OnePlus        | 13                        | Snapdragon 8 Elit… | 2024-11-01   | U      |       24 |    0.0006% |
| 1054 | ulova            | Xiaomi         | Redmi 4A, Redmi 5A, Redm… | Snapdragon 425     | 2016-11-01   | U      |       23 |    0.0005% |
| 1054 | tenet            |                |                           |                    |              | U      |       23 |    0.0005% |
| 1054 | sirisu           | Google         | Pixel 2 XL                | Snapdragon 835     | 2017-10-17   | U      |       23 |    0.0005% |
| 1054 | nx619j           | Nubia          | Red Magic Mars            | Snapdragon 845     | 2018-12-01   | O      |       23 |    0.0005% |
| 1054 | gts9wifi         | Samsung        | Galaxy Tab S9 (SM-X710)   | Snapdragon 8 Gen 2 | 2023-08-11   | U      |       23 |    0.0005% |
| 1054 | emerald          | Teracube       | 2e (2022)                 | Helio A25          | 1905-07-14   | U      |       23 |    0.0005% |
| 1054 | a5ul             | HTC            | Desire 816                | Snapdragon 400     | 2014-04-01   | U      |       23 |    0.0005% |
| 1054 | X00I             | ASUS           | ZenFone 4 Max (ZC554KL)   | Snapdragon 430     | 2017-07-01   | U      |       23 |    0.0005% |
| 1062 | ziyi             | Xiaomi         | 13 Lite                   | Snapdragon 7 Gen 1 | 2023-02-26   | U      |       22 |    0.0005% |
| 1062 | us996d           | LG             | V20 (GSM Unlocked - Dirt… | Snapdragon 820     | 2016-10-01   | D      |       22 |    0.0005% |
| 1062 | smi              | Motorola       | Razr I (XT890)            | Atom Z2460         | 2012-10-01   | U      |       22 |    0.0005% |
| 1062 | a5y17ltelgt      | Samsung        | Galaxy A5 (2017) (SM-A52… | Exynos 7 Octa 7880 | 2017-01-01   | U      |       22 |    0.0005% |
| 1062 | CK8n             | TECNO          | CAMON 20 Pro 5G           | Dimensity 8050     | 2023-05-09   | U      |       22 |    0.0005% |
| 1067 | m33x             | Samsung        | Galaxy Jump2              | Dimensity 700      | 2022-06-01   | U      |       21 |    0.0005% |
| 1067 | kltedcm          | Samsung        | Galaxy S5 (G900T)         | Snapdragon 801 MS… | 2014-04-11   | U      |       21 |    0.0005% |
| 1067 | chef             | Motorola       | one power                 | Snapdragon 636     | 2018-10-10   | D      |       21 |    0.0005% |
| 1067 | OP46B1           | OPPO           | Reno 标准版  (PCAM00)        | Snapdragon 710     | 2019-04-01   | U      |       21 |    0.0005% |
| 1071 | winner           | Samsung        | Galaxy Fold, Galaxy Fold… | Snapdragon 855     | 2019-04-01   | U      |       20 |    0.0005% |
| 1071 | sydneym          | Huawei         | Mate 20 Lite              | Kirin 710          | 2018-09-01   | U      |       20 |    0.0005% |
| 1071 | shamrock         | General Mobile | GM 5 Plus                 | Snapdragon 617     | 2016-02-01   | U      |       20 |    0.0005% |
| 1071 | plato            | Xiaomi         | 12T                       | Dimensity 8100-Ul… | 2022-10-01   | U      |       20 |    0.0005% |
| 1071 | fortunafz        | Samsung        | Galaxy Grand Prime (SM-S… | Snapdragon 410 (M… | 2014-10-01   | U      |       20 |    0.0005% |
| 1071 | eqe              | Motorola       | edge 50 pro               | Snapdragon 7 Gen 3 | 2024-04-08   | U      |       20 |    0.0005% |
| 1071 | e1q              | LG             | K4 (LG-K120GT, LG-K121, … | Snapdragon 210     | 2016-02-01   | U      |       20 |    0.0005% |
| 1071 | amber            | Xiaomi         | 11T                       | Dimensity 1200-Ul… | 2021-10-05   | U      |       20 |    0.0005% |
| 1079 | udon             | Xiaomi         | Mi MIX 4                  | Snapdragon 888+ 5… | 2021-08-16   | U      |       19 |    0.0004% |
| 1079 | taoshan          | Sony           | Xperia L                  | Snapdragon 400 (M… | 2013-05-01   | D      |       19 |    0.0004% |
| 1079 | penang           | Motorola       | moto G53 (XT2335-3)       | Snapdragon 480 Pl… | 2022-12-15   | U      |       19 |    0.0004% |
| 1079 | kltechnduo       | Samsung        | Galaxy S5 LTE Duos (G900… | Snapdragon 801     | 2014-04-01   | D      |       19 |    0.0004% |
| 1079 | juice            | Xiaomi         | Redmi 9T, POCO M3, Redmi… | Snapdragon 662     | 2021-01-08   | U      |       19 |    0.0004% |
| 1079 | jagnm            | LG             | G3 Beat                   | Snapdragon 400     | 2014-08-01   | D      |       19 |    0.0004% |
| 1079 | ebba             | OnePlus        | Nord CE 5G                | Snapdragon 750G    | 2021-06-11   | U      |       19 |    0.0004% |
| 1079 | dreamqlteue      | Samsung        | Galaxy S8 (SM-G950U1)     | Snapdragon 835     | 2017-04-24   | U      |       19 |    0.0004% |
| 1079 | c1q              | Samsung        | Galaxy Note20 5G (SM-N98… | Snapdragon 8 Gen 3 | 2020-08-21   | U      |       19 |    0.0004% |
| 1079 | b0s              | Samsung        | Galaxy S22 Ultra (SM-S90… | Exynos 2200        | 2022-02-25   | U      |       19 |    0.0004% |
| 1079 | OP4EFDL1         | OPPO           | A53                       | Snapdragon 460     | 2020-08-25   | U      |       19 |    0.0004% |
| 1079 | OP4BA5L1         | OPPO           | OPPO Reno 4 (CPH2109, CP… | Snapdragon 720G    | 2020-08-01   | U      |       19 |    0.0004% |
| 1079 | KJ5              | TECNO          | SPARK 20                  | Helio G85          | 2023-12-01   | U      |       19 |    0.0004% |
| 1092 | penangf          | Motorola       | moto g13                  | Helio G85 (MT6769… | 2023-01-24   | U      |       18 |    0.0004% |
| 1092 | passion          | Lenovo         | Vibe P1                   | Snapdragon 615     | 2015-10-01   | U      |       18 |    0.0004% |
| 1092 | m8d              | HTC            | One (M8) Dual SIM         | Snapdragon 801     | 2014-06-01   | D      |       18 |    0.0004% |
| 1092 | m53x             | Samsung        | Galaxy M53 5G (SM-M536B,… | Dimensity 900 5G   | 2022-04-07   | U      |       18 |    0.0004% |
| 1092 | h96_max_x3       | H96            | Max X3                    | Amlogic S905X3     | 2020-02-01   | U      |       18 |    0.0004% |
| 1092 | h815_usu         | LG             | G4                        | Snapdragon 808     | 2015-04-01   | U      |       18 |    0.0004% |
| 1092 | d2spr            | Samsung        | Galaxy S III (Sprint)     | Snapdragon S4 Plus | 2012-06-28   | D      |       18 |    0.0004% |
| 1092 | apollopro        | Xiaomi         | Mi 10T pro                | Snapdragon 865     | 2020-10-13   | U      |       18 |    0.0004% |
| 1092 | a82xq            | Samsung        | Galaxy Quantum2           | Snapdragon 855+    | 2021-04-01   | U      |       18 |    0.0004% |
| 1101 | tsubasa          | Sony           | Xperia V                  | Snapdragon S4      | 2012-09-01   | D      |       17 |    0.0004% |
| 1101 | star2qlteue      | Samsung        | Galaxy S9+ (SM-G965U1)    | Snapdragon 845     | 2018-03-01   | U      |       17 |    0.0004% |
| 1101 | poplar_kddi      | Sony           | Xperia XZ1 (SOV36)        | Snapdragon 835     | 2017-09-19   | U      |       17 |    0.0004% |
| 1101 | otus             | Motorola       | moto e (2015)             | Snapdragon 200 (M… | 2015-02-25   | D      |       17 |    0.0004% |
| 1101 | odroidgo3        | HardKernel     | ODROID go3                |                    | 2022-10-04   | U      |       17 |    0.0004% |
| 1101 | nobleltetmo      | Samsung        | Galaxy Note5              | Exynos 7420 Octa   | 2015-08-01   | U      |       17 |    0.0004% |
| 1101 | m5_tab           | Banana Pi      | M5 (Tablet)               | Amlogic S905X3     | 2020-12-01   | O      |       17 |    0.0004% |
| 1101 | klteaio          | Samsung        | Galaxy S5 LTE (G900AZ/S9… | Snapdragon 801     | 2014-04-11   | D      |       17 |    0.0004% |
| 1101 | houji            | Xiaomi         | 14                        | Snapdragon 8 Gen 3 | 2023-11-01   | U      |       17 |    0.0004% |
| 1101 | fortunalteub     | Samsung        | Galaxy Grand Prime  (for… | Snapdragon 410     | 2014-10-01   | U      |       17 |    0.0004% |
| 1101 | X00H             | ASUS           | ZenFone 4 Max (ZC520KL)   | Qualcomm Snapdrag… | 2017-07-01   | U      |       17 |    0.0004% |
| 1112 | zangya           | BQ             | Aquaris X2                | Snapdragon 636     | 2018-05-01   | D      |       16 |    0.0004% |
| 1112 | owens            | Motorola       | Moto E4 Plus (Qualcomm)   | Qualcomm Snapdrag… | 2017-06-01   | U      |       16 |    0.0004% |
| 1112 | mint             | Sony           | Xperia T                  | Snapdragon S4      | 2012-09-01   | D      |       16 |    0.0004% |
| 1112 | luigi            | Realme         | 10 Pro 5G                 | Snapdragon 695 (S… | 2022-11-24   | O      |       16 |    0.0004% |
| 1112 | jackpotlte       | Samsung        | Galaxy A8 2018            | Exynos 7885        | 2018-01-01   | U      |       16 |    0.0004% |
| 1112 | j5ltekx          | Samsung        | Galaxy J5 (SM-J500N0)     | Snapdragon 410     | 2015-06-01   | U      |       16 |    0.0004% |
| 1112 | dogo             | Sony           | Xperia ZR                 | Snapdragon S4 Pro  | 2013-06-01   | D      |       16 |    0.0004% |
| 1112 | cs02             | Samsung        | Galaxy Core Plus (SM-G35… | Broadcom BCM21664T | 2013-11-01   | U      |       16 |    0.0004% |
| 1112 | TP1803           | Nubia          | Mini 5G                   | Snapdragon 855     | 2019-04-01   | O      |       16 |    0.0004% |
| 1112 | OP4B79L1         | OPPO           | A5 (2020)                 | Snapdragon 665 (1… | 2019-10-01   | U      |       16 |    0.0004% |
| 1122 | z3dual           | Sony           | Xperia Z3 Dual            | Snapdragon 801     | 2014-09-01   | U      |       15 |    0.0004% |
| 1122 | wly              | OnePlus        | 10 Pro                    | Snapdragon 8 Gen 1 | 2022-01-13   | U      |       15 |    0.0004% |
| 1122 | vitamin          | OnePlus        | Nord 3                    | Dimensity 9000     | 2023-07-11   | U      |       15 |    0.0004% |
| 1122 | ulysse           | Xiaomi         | Redmi Note 5A, Redmi Not… | Snapdragon 425 or… | 2017-08-01   | U      |       15 |    0.0004% |
| 1122 | tbelteskt        | Samsung        | Galaxy Note Edge          | Snapdragon 805     | 2014-11-01   | U      |       15 |    0.0004% |
| 1122 | sisleyr          | Lenovo         | S90-A Sisley              | Snapdragon 410 (M… | 2014-11-01   | U      |       15 |    0.0004% |
| 1122 | r7sf             | OPPO           | R7s (International)       | Snapdragon 615     | 2015-11-01   | D      |       15 |    0.0004% |
| 1122 | ph2n             | LG             | Stylo 2 Plus              | Snapdragon 430 (M… | 2016-07-01   | U      |       15 |    0.0004% |
| 1122 | nx609j           | Nubia          | Red Magic                 | Snapdragon 835     | 2018-04-01   | D      |       15 |    0.0004% |
| 1122 | himaul           | HTC            | One M9 (GSM)              | Snapdragon 810     | 2015-03-01   | D      |       15 |    0.0004% |
| 1122 | expressltexx     | Samsung        | Galaxy Express (GT-I8730… | Snapdragon 400 (M… | 2013-03-01   | U      |       15 |    0.0004% |
| 1122 | dreamqltecan     | Samsung        | Galaxy S8 (SM-G950W)      | Snapdragon 835     | 2017-04-21   | U      |       15 |    0.0004% |
| 1122 | dream2qlteue     | Samsung        | Galaxy S8+ (SM-G955U1)    | Snapdragon 835 (1… | 2017-04-01   | U      |       15 |    0.0004% |
| 1122 | ctwo             | Motorola       | edge 50 ultra             | Snapdragon 8s Gen… | 2024-05-01   | U      |       15 |    0.0004% |
| 1122 | X6871            | Infinix        | GT 20 Pro                 | Dimensity 8200 Ul… | 2024-04-26   | U      |       15 |    0.0004% |
| 1137 | zircon           | Xiaomi         | Redmi Note 13 Pro+        | Dimensity 7200 Ul… | 2023-09-21   | U      |       14 |    0.0003% |
| 1137 | piccolo          | BQ             | Aquaris M5                | Snapdragon 615     | 2015-08-01   | D      |       14 |    0.0003% |
| 1137 | lv517            | LG             | K20 (2019), K8+           | Mediatek MT6739    | 2019-09-01   | U      |       14 |    0.0003% |
| 1137 | h812_usu         | LG             | G4 (LG-H812)              | Snapdragon 808     | 2015-04-01   | U      |       14 |    0.0003% |
| 1137 | greatqlteue      | Samsung        | Galaxy Note8 SM-N950U1    | Snapdragon 835     | 2017-09-01   | U      |       14 |    0.0003% |
| 1137 | gracerltektt     | Samsung        | Galaxy Note Fan Edition … | Exynos 8890        | 2017-07-07   | U      |       14 |    0.0003% |
| 1137 | a6010            | Lenovo         | A6010                     | Snapdragon 410     | 2015-11-01   | U      |       14 |    0.0003% |
| 1144 | v480             | LG             | G Pad 8.0 (Wi-Fi)         | Snapdragon 400 (M… | 2014-07-01   | D      |       13 |    0.0003% |
| 1144 | serranoltespr    | Samsung        | Galaxy S4 Mini (SPH-L520) | Snapdragon 400     | 2013-07-01   | U      |       13 |    0.0003% |
| 1144 | rio              | Huawei         | G8, GX8                   | Snapdragon 615 (2… | 2015-10-01   | U      |       13 |    0.0003% |
| 1144 | nx651j           | Nubia          | Play 5G, Red Magic 5G Li… | Snapdragon 765G (… | 2020-04-01   | D      |       13 |    0.0003% |
| 1144 | flounder_lte     | Google         | Nexus 9 (LTE)             | Tegra K1 (T124)    | 2014-11-03   | D      |       13 |    0.0003% |
| 1144 | f1f              | OPPO           | F1 (International)        | Snapdragon 615     | 2016-01-01   | D      |       13 |    0.0003% |
| 1144 | dream2qltecan    | Samsung        | Galaxy S8+ (SM-G955W)     | Snapdragon 835     | 2017-04-01   | U      |       13 |    0.0003% |
| 1144 | d852             | LG             | G3 (Canada)               | Snapdragon 801     | 2014-06-01   | D      |       13 |    0.0003% |
| 1144 | d2tmo            | Samsung        | Galaxy S III (T-Mobile)   | Snapdragon S4 Plu… | 2012-06-21   | D      |       13 |    0.0003% |
| 1144 | P1m              | Lenovo         | Vibe P1m                  | MediaTek MT6735P   | 2015-10-01   | U      |       13 |    0.0003% |
| 1154 | willow           | Xiaomi         | Redmi Note 8T             | Snapdragon 665 (1… | 2019-11-08   | U      |       12 |    0.0003% |
| 1154 | prague           | Huawei         | P8 Lite (2017)            | Kirin 655          | 2017-01-01   | U      |       12 |    0.0003% |
| 1154 | paros            |                |                           |                    |              | U      |       12 |    0.0003% |
| 1154 | jfltevzw         | Samsung        | Galaxy S4 (SCH-I545)      | Snapdragon 600 (A… | 2013-04-01   | D      |       12 |    0.0003% |
| 1154 | jflteatt         | Samsung        | Galaxy S4 (SGH-I337)      | Snapdragon 600     | 2013-04-01   | D      |       12 |    0.0003% |
| 1154 | j7xlte           | Samsung        | Galaxy J7 (2016) (SM-J71… | Exynos 7870        | 2016-04-01   | U      |       12 |    0.0003% |
| 1154 | figo             | Huawei         | P Smart                   | Kirin 659          | 2017-12-01   | D      |       12 |    0.0003% |
| 1154 | crownqltechn     | Samsung        | Galaxy Note9 (SM-N9600)   | Snapdragon 845     | 2018-08-01   | U      |       12 |    0.0003% |
| 1154 | a53gxx           | Samsung        | Galaxy A5 (SM-A500H)      | Snapdragon 410     | 2014-12-01   | U      |       12 |    0.0003% |
| 1163 | y560             | Huawei         | Y5, Y560                  | Snapdragon 210     | 2015-06-01   | U      |       11 |    0.0003% |
| 1163 | r7plus           | OPPO           | R7 Plus (International)   | Snapdragon 615     | 2015-05-01   | D      |       11 |    0.0003% |
| 1163 | kltevzw          | Samsung        | Galaxy S4 (Verizon, SCH-… | Snapdragon 600     | 2013-05-01   | U      |       11 |    0.0003% |
| 1163 | i9100g           | Samsung        | Galaxy S2 Plus (GT-I9100… | OMAP 4430          | 2013-01-01   | U      |       11 |    0.0003% |
| 1163 | hayabusa         | Sony           | Xperia TX                 | Snapdragon S4      | 2012-08-01   | D      |       11 |    0.0003% |
| 1163 | f400             | LG             | G3 (Korea)                | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1163 | d851             | LG             | G3 (T-Mobile)             | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1163 | d850             | LG             | G3 (AT&T)                 | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1163 | a7lte            | Samsung        | Galaxy A7 (2018) (SM-A70… | Exynos 5430 Octa   | 2018-10-01   | U      |       11 |    0.0003% |
| 1163 | A5_Pro           | Umidigi        | A5 Pro                    | Helio P23          | 2019-05-01   | U      |       11 |    0.0003% |
| 1173 | sif              | NVIDIA         | Shield TV (2019) [Androi… | Tegra X1+ (T210b0… | 2019-10-28   | O      |       10 |    0.0002% |
| 1173 | p7_l10           | Huawei         | Ascend P7 (P7-L10)        | Kirin 910T         | 2014-06-01   | U      |       10 |    0.0002% |
| 1173 | odroidn2l        | HardKernel     | ODROID-N2L                | Amlogic S922X      | 2022-11-01   | U      |       10 |    0.0002% |
| 1173 | nicki            | Sony           | Xperia M                  | Snapdragon S4 Plus | 2013-06-01   | D      |       10 |    0.0002% |
| 1173 | messi            | Motorola       | moto z3                   | Snapdragon 835 (M… | 2018-08-01   | O      |       10 |    0.0002% |
| 1173 | ls990            | LG             | G3 (Sprint)               | Snapdragon 801     | 2014-06-01   | D      |       10 |    0.0002% |
| 1173 | jalebi           | YU             | Yunique                   | Snapdragon 410 (M… | 2015-09-01   | D      |       10 |    0.0002% |
| 1173 | htc_820g_plus    | HTC            | Desire 820G+ dual sim     | MediaTek MT6592    | 2015-06-01   | U      |       10 |    0.0002% |
| 1173 | gohan            | BQ             | Aquaris X5 Plus           | Snapdragon 652     | 2016-07-01   | D      |       10 |    0.0002% |
| 1173 | d800             | LG             | G2 (AT&T)                 | Snapdragon 800 (M… | 2013-09-12   | D      |       10 |    0.0002% |
| 1173 | coreprimeve3g    | Samsung        | Galaxy Core Prime (SM-G3… | Spreadtrum SC7730S | 2014-11-01   | U      |       10 |    0.0002% |
| 1173 | a5ltexx          | Samsung        | Galaxy A5 (SM-A500F/G)    | Snapdragon 410     | 2014-11-01   | U      |       10 |    0.0002% |
| 1185 | vegetalte        | BQ             | Aquaris E5 4G, Aquaris E… | Snapdragon 410     | 2014         | D      |        9 |    0.0002% |
| 1185 | v410             | LG             | G Pad 7.0 (LTE)           | Snapdragon 400 (M… | 2014-05-01   | D      |        9 |    0.0002% |
| 1185 | trltexx          | Samsung        | Galaxy Note4 (SM-N910F/G… | Snapdragon 805     | 2014-10-01   | U      |        9 |    0.0002% |
| 1185 | trelte           | Samsung        | Galaxy Note4 (SM-N910C)   | Exynos 5433        | 2014-10-01   | U      |        9 |    0.0002% |
| 1185 | toro             | Google         | Galaxy Nexus LTE (Verizo… | OMAP 4460          | 2011-12-15   | D      |        9 |    0.0002% |
| 1185 | h932             | LG             | V30 (T-Mobile)            | Snapdragon 835 (M… | 2017-08-01   | D      |        9 |    0.0002% |
| 1185 | h930             | LG             | V30 (LG-H930)             | Snapdragon 835     | 2017-09-21   | U      |        9 |    0.0002% |
| 1185 | frescoltekor     | Samsung        | Galaxy Note3 Neo (SM-N75… | Exynos 5260        | 2014-03-01   | U      |        9 |    0.0002% |
| 1185 | anne             | Huawei         | P20 Lite                  | Kirin 659          | 2018-03-01   | D      |        9 |    0.0002% |
| 1185 | a70s             | Samsung        | Galaxy A70s               | Snapdragon 675     | 2019-10-01   | U      |        9 |    0.0002% |
| 1185 | I01WD            | ASUS           | Zenfone 6 (ZS630KL)       | Snapdragon 855 (S… | 2019-05-16   | D      |        9 |    0.0002% |
| 1196 | w5               | LG             | Optimus L70               | Snapdragon 200     | 2014-04-01   | D      |        8 |    0.0002% |
| 1196 | sltecan          | Samsung        | Galaxy Alpha (SM-G850W)   | Exynos 5430        | 2014-09-01   | U      |        8 |    0.0002% |
| 1196 | s3_h560          | JiaYu          | S3                        | MediaTek MT6752    | 2015-01-01   | U      |        8 |    0.0002% |
| 1196 | onc              | Xiaomi         | Redmi 7                   | Snapdragon 632     | 2019-03-20   | U      |        8 |    0.0002% |
| 1196 | obiwan           | ASUS           | ROG Phone 3               | Snapdragon 865+ (… | 2020-08-01   | D      |        8 |    0.0002% |
| 1196 | mdarcy           | NVIDIA         | Shield TV 2019 Pro [Andr… | Tegra X1+ (T210b0… | 2019-10-28   | D      |        8 |    0.0002% |
| 1196 | m8qlul           | HTC            | ONE M8s                   | Snapdragon 615 (M… | 2015-05-01   | U      |        8 |    0.0002% |
| 1196 | gtesqltespr      | Samsung        | Galaxy Tab E 8.0 LTE (Sp… | Snapdragon 410 (M… | 2016-01-01   | D      |        8 |    0.0002% |
| 1196 | flashlm          | LG             | V50 (LM-V500XM), V50 Thi… | Snapdragon 855     | 2019-05-01   | U      |        8 |    0.0002% |
| 1196 | ef56             | Pantech        | Vega LTE-A                | Snapdragon 801 (M… | 2014-05-01   | U      |        8 |    0.0002% |
| 1196 | caza             | Nubia          | Z60 Ultra, Red Magic 9 P… | Snapdragon 8 Gen … | 2023-12-19   | U      |        8 |    0.0002% |
| 1196 | caymanslm        | LG             | Velvet                    | Snapdragon 845     | 2020-07-31   | O      |        8 |    0.0002% |
| 1196 | ahannah          | Motorola       | moto e5 plus (XT1924-3/9) | Snapdragon 430     | 2018-05-01   | D      |        8 |    0.0002% |
| 1196 | Tiare_4_19       | Xiaomi         | Redmi Go (tiare)          | Snapdragon 425     | 2019-02-01   | U      |        8 |    0.0002% |
| 1210 | x500             | ZTE            | X500                      | Snapdragon S1 (MS… | 2011-09-26   | U      |        7 |    0.0002% |
| 1210 | urd              | ZTE            | Z981                      | Snapdragon 617     | 2016-07-01   | U      |        7 |    0.0002% |
| 1210 | unified7870      | Samsung        | Exynos 7870 Device        | Exynos 7870        |              | U      |        7 |    0.0002% |
| 1210 | r5xQ             | Realme         | 5, 5i, 5s                 | Snapdragon 665 SD… | 2019-08-01   | U      |        7 |    0.0002% |
| 1210 | poplar_canada    | Sony           | Xperia XZ1 (Canada)       | Snapdragon 835     | 2017-08-15   | U      |        7 |    0.0002% |
| 1210 | light            | Xiaomi         | POCO M4 5G, Redmi 10 5G … | Dimensity 700      | 2021-03-04   | U      |        7 |    0.0002% |
| 1210 | gemstone         | Xiaomi         | POCO X5 5G, Redmi Note 1… | Snapdragon 4 Gen … | 2023-01-05   | U      |        7 |    0.0002% |
| 1210 | GM8_sprout       | General Mobile | GM 8                      | Snapdragon 435     | 2018-02-01   | U      |        7 |    0.0002% |
| 1210 | G                | 10.or          | G, Tenor G                | Snapdragon 626 (M… | 2017-10-03   | D      |        7 |    0.0002% |
| 1219 | x1               |                |                           |                    |              | U      |        6 |    0.0001% |
| 1219 | wilcoxltexx      | Samsung        | Galaxy Express 2, Galaxy… | Snapdragon S4      | 2013-10-01   | U      |        6 |    0.0001% |
| 1219 | v521             | LG             | G Pad X (T-Mobile)        | Snapdragon 617 (M… | 2016-06-01   | D      |        6 |    0.0001% |
| 1219 | v400             | LG             | G Pad 7.0 WiFi            | Snapdragon 400 (M… | 2014-07-01   | D      |        6 |    0.0001% |
| 1219 | sabrina          | Google         | Chromecast with Google T… | Amlogic S905D3G    | 2020-09-01   | O      |        6 |    0.0001% |
| 1219 | pdx223           | Sony           | Xperia 1 IV               | Snapdragon 8 Gen … | 2022-06-11   | U      |        6 |    0.0001% |
| 1219 | osaka            | Motorola       | Moto G Stylus 5G 2021     | Snapdragon 480 5G  | 2021-06-14   | U      |        6 |    0.0001% |
| 1219 | maverick         | Amazon         | Fire HD 10 9th gen        | Helio P60T (MT818… | 2019-10-01   | U      |        6 |    0.0001% |
| 1219 | maserati         | Motorola       | DROID 4                   | OMAP 4430          | 2012-02-10   | D      |        6 |    0.0001% |
| 1219 | ls997            | LG             | V20 (Sprint)              | Snapdragon 820 (M… | 2016-10-01   | D      |        6 |    0.0001% |
| 1219 | kltespr          | Samsung        | Galaxy S5 (SM-G900P)      | Snapdragon 801 (M… | 2014-04-01   | U      |        6 |    0.0001% |
| 1219 | kinzie           | Motorola       | DROID Turbo 2             | Snapdragon 810     | 2015-10-01   | U      |        6 |    0.0001% |
| 1219 | h811             | LG             | G4 (T-Mobile)             | Snapdragon 808     | 2015-06-01   | D      |        6 |    0.0001% |
| 1219 | fugu             | Google         | Nexus Player              | Atom Z3560         | 2014-10-01   | D      |        6 |    0.0001% |
| 1219 | ef71             | Pantech        | SKY IM-100                | Snapdragon 430 (M… | 2016-06-01   | U      |        6 |    0.0001% |
| 1219 | deadpool         | Google         | ADT-3                     | Amlogic S905Y2     | 2020-09-22   | O      |        6 |    0.0001% |
| 1219 | d801             | LG             | G2 (T-Mobile)             | Snapdragon 800 (M… | 2013-09-12   | D      |        6 |    0.0001% |
| 1219 | d2vzw            | Samsung        | Galaxy S III (Verizon)    | Snapdragon S4 Plu… | 2012-06-28   | D      |        6 |    0.0001% |
| 1219 | akershus         | ZTE            | Axon 9 Pro                | Snapdragon 845 (S… | 2018-11-01   | O      |        6 |    0.0001% |
| 1219 | Z00D             | ASUS           | Zenfone 2 (ZE500CL)       | Atom Z2560         | 2015-03-01   | D      |        6 |    0.0001% |
| 1219 | A7010a48         | Lenovo         | VIBE X3 Lite, A7010       | MediaTek MT6753    | 2015-12-01   | U      |        6 |    0.0001% |
| 1240 | vidofnir         | Volla Phone    | X23 (Gigaset GX4)         | Helio G99          | 2023-05-01   | U      |        5 |    0.0001% |
| 1240 | us997            | LG             | G6 (US Unlocked)          | Snapdragon 821 (M… | 2017-02-01   | D      |        5 |    0.0001% |
| 1240 | tenshi           | BQ             | Aquaris U Plus            | Snapdragon 430 (M… | 2016-06-01   | D      |        5 |    0.0001% |
| 1240 | rs988            | LG             | G5 (US Unlocked)          | Snapdragon 820     | 2016-02-01   | D      |        5 |    0.0001% |
| 1240 | radxa0_tab       | Radxa          | Zero (Tablet)             | Amlogic S905Y2     | 2020-12-01   | O      |        5 |    0.0001% |
| 1240 | p839v55          | Vodafona       | Smart ultra 6             | Snapdragon 615 (M… | 2015-07-01   | U      |        5 |    0.0001% |
| 1240 | nx512j           | Nubia          | Z9 Max                    | Snapdragon 615 (M… | 2015-06-01   | D      |        5 |    0.0001% |
| 1240 | krillin          | BQ             | Aquaris E4.5              | MediaTek MT6582    | 2014-06-01   | U      |        5 |    0.0001% |
| 1240 | j3xprolte        | Samsung        | Galaxy J3 Pro (SM-J3110,… | Spreadtrum SC9830i | 2016-06-01   | U      |        5 |    0.0001% |
| 1240 | iris             | ZTE            | Grand S Flex              | Snapdragon 400 (M… | 2013-11-01   | U      |        5 |    0.0001% |
| 1240 | draconis         | ZTE            | Z970                      | Snapdragon 400 (M… | 2014-08-01   | U      |        5 |    0.0001% |
| 1240 | chaozu           | BQ             | Aquaris U                 | Snapdragon 430 (M… | 2016-06-01   | D      |        5 |    0.0001% |
| 1240 | agate            | Xiaomi         | 11T                       | Dimensity 1200-Ul… | 2021-10-05   | U      |        5 |    0.0001% |
| 1240 | Z008             | ASUS           | Zenfone 2 (720p)          | Atom Z3560         | 2015-03-01   | D      |        5 |    0.0001% |
| 1240 | RMX3242          | Realme         | Narzo 30 5G               | Dimensity 700      | 2021-06-24   | U      |        5 |    0.0001% |
| 1255 | v1               | Motorola       | Moto G5 Plus (XT1687)     | Snapdragon 625 MS… | 2017-04-01   | U      |        4 |   0.00009% |
| 1255 | umts_spyder      | Motorola       | DROID RAZR (GSM), DROID … | OMAP 4430          | 2011-11-11   | D      |        4 |   0.00009% |
| 1255 | serranolteusc    | Samsung        | Galaxy S4 Mini (SCH-R890) | Snapdragon 400     | 2013-07-01   | U      |        4 |   0.00009% |
| 1255 | odroidc4_tab     | HardKernel     | ODROID-C4 (Tablet)        | Amlogic S905X3     | 2020-12-01   | O      |        4 |   0.00009% |
| 1255 | nx589j           | Nubia          | Z17 mini S (NX589J)       | Snapdragon 653     | 2017-10-19   | U      |        4 |   0.00009% |
| 1255 | kipper           | Wileyfox       | Storm                     | Snapdragon 615 (M… | 2015-11-01   | D      |        4 |   0.00009% |
| 1255 | j7ltechn         | Samsung        | Galaxy J7 (SM-J7008)      | Snapdragon 615     | 2015-06-01   | U      |        4 |   0.00009% |
| 1255 | j5ltexx          | Samsung        | Galaxy J5 (SM-J5007/F/G/… | Snapdragon 410     | 2015-07-28   | U      |        4 |   0.00009% |
| 1255 | j3xltebmc        | Samsung        | Galaxy J3 (2016) (SM-J32… | Snapdragon 410     | 2016-05-01   | U      |        4 |   0.00009% |
| 1255 | d838             | LG             | G Pro2 (LG-D838)          | Snapdragon 800     | 2014-02-21   | U      |        4 |   0.00009% |
| 1255 | cas              | Xiaomi         | Mi 10 Ultra               | Snapdragon 865 5G… | 2020-08-16   | U      |        4 |   0.00009% |
| 1255 | X00QD            | ASUS           | ZenFone 5 (ZE620KL)       | Snapdragon 636     | 2018-04-01   | U      |        4 |   0.00009% |
| 1255 | NX679J           | Nubia          | RedMagic 7 5G (NX679J)    | Snapdragon 8 Gen 1 | 2022-02-01   | U      |        4 |   0.00009% |
| 1268 | x1slte           | Gionee         | X1S                       | MediaTek MT6737T   | 2017-09-01   | U      |        3 |   0.00007% |
| 1268 | vs985            | LG             | G3 (Verizon)              | Snapdragon 801 (M… | 2014-06-01   | D      |        3 |   0.00007% |
| 1268 | vee7             | LG             | Optimus L7 II (vee7e), L… | Snapdragon S4 Pla… | 2013-03-01   | U      |        3 |   0.00007% |
| 1268 | sydney           | Huawei         | Nova 3i Sydney            | Kirin 710          | 2018-07-27   | U      |        3 |   0.00007% |
| 1268 | sf340n           | LG             | Stylo 3 Plus              | Snapdragon 435     | 2017-05-01   | U      |        3 |   0.00007% |
| 1268 | r5               | OPPO           | R5 (International), R5s … | Snapdragon 615     | 2014-12-01   | D      |        3 |   0.00007% |
| 1268 | nemo             | LG             | Watch Urbane 2nd Edition… | Snapdragon 400     | 2016-03-01   | U      |        3 |   0.00007% |
| 1268 | m7vzw            | HTC            | One (Verizon)             | Snapdragon 600 (A… | 2013-03-01   | D      |        3 |   0.00007% |
| 1268 | logan            | Samsung        | Galaxy Ace3  (GT-S7270, … | Broadcom BCM21664  | 2013-06-01   | U      |        3 |   0.00007% |
| 1268 | kltesprsports    | Samsung        | Galaxy S5 Sport           | Snapdragon 801 (M… | 2014-06-23   | D      |        3 |   0.00007% |
| 1268 | j3ltekx          | Samsung        | Galaxy J3 (2016) (SM-J32… | Snapdragon 410 MS… | 2016-05-06   | U      |        3 |   0.00007% |
| 1268 | himawl           | HTC            | One M9 (Verizon)          | Snapdragon 810 (M… | 2015-03-01   | D      |        3 |   0.00007% |
| 1268 | h96pro           | H96            | Pro Plus                  | Amlogic S912       | 2017-02-01   | U      |        3 |   0.00007% |
| 1268 | fortuna3gdtv     | Samsung        | Galaxy Grand Prime (SM-G… | Snapdragon 410     | 2014-10-01   | U      |        3 |   0.00007% |
| 1268 | cusco            | Motorola       | edge 50 fusion            | Snapdragon 7s Gen… | 2024-05-01   | U      |        3 |   0.00007% |
| 1268 | I001D            | ASUS           | ROG Phone 2 (ZS660KL)     | Snapdragon 855+ (… | 2019-09-01   | D      |        3 |   0.00007% |
| 1284 | xt897            | Motorola       | PHOTON Q 4G LTE           | Snapdragon S4 Plu… | 2012-08-19   | D      |        2 |   0.00005% |
| 1284 | trltevzw         | Samsung        | Galaxy Note4 (SM-N910V)   | Snapdragon 805     | 2014-10-01   | U      |        2 |   0.00005% |
| 1284 | tomato           | YU             | Yureka, Yureka Plus       | Snapdragon 615 (M… | 2014-12-18   | D      |        2 |   0.00005% |
| 1284 | style3lm         | LG             | Style3                    | Snapdragon 845 (S… | 2020-06-25   | O      |        2 |   0.00005% |
| 1284 | radxa02          | Radxa          | Zero 2 (Android TV)       | Amlogic S905D3     | 2022-12-01   | O      |        2 |   0.00005% |
| 1284 | peach            | ARK            | Benefit A3                | Snapdragon 410 (M… | 2015-07-01   | D      |        2 |   0.00005% |
| 1284 | m216             | LG             | K10                       | Snapdragon 410 (M… | 2016-01-01   | D      |        2 |   0.00005% |
| 1284 | lettuce          | YU             | Yuphoria                  | Snapdragon 410 (M… | 2015-05-12   | D      |        2 |   0.00005% |
| 1284 | idol4            | Alcatel        | Idol 4 (6055A)            | Snapdragon 617     | 2016-06-01   | U      |        2 |   0.00005% |
| 1284 | h810_usu         | LG             | G4 (LG-H810)              | Snapdragon 808     | 2015-04-01   | U      |        2 |   0.00005% |
| 1284 | d803             | LG             | G2 (Canadian)             | Snapdragon 800 (M… | 2013-09-12   | D      |        2 |   0.00005% |
| 1284 | che10            | Huawei         | Honor 4x (China Telecom)  | Snapdragon 410 (M… | 2014-10-01   | D      |        2 |   0.00005% |
| 1284 | berkeley         | Huawei         | Honor View 10             | Kirin 970          | 2018-01-01   | D      |        2 |   0.00005% |
| 1284 | Z00RD            | ASUS           | ZenFone 2 Laser (ZE500KG) | Snapdragon 410     | 2015-08-01   | U      |        2 |   0.00005% |
| 1284 | X5_Max_Pro       | Doogee         | X5 Max Pro                | MediaTek MT6737    | 2016-06-01   | U      |        2 |   0.00005% |
| 1284 | Samsung Galaxy … | Samsung        | Galaxy S8 Plus (SM-G955F) | Exynos 8895        | 2017-04-21   | U      |        2 |   0.00005% |
| 1284 | GS290            | Gigaset        | GS290                     | Helio P22 (MT6762) | 2019-11-01   | U      |        2 |   0.00005% |
| 1301 | spyder           | Motorola       | DROID RAZR (CDMA), DROID… | OMAP 4430          | 2011-11-11   | D      |        1 |   0.00002% |
| 1301 | shamu_t          | Motorola       | Moto X Pro (China)        | Snapdragon 805     | 2015-01-01   | U      |        1 |   0.00002% |
| 1301 | seed             | Google         | Android One 2nd Gen       | Snapdragon 410 (M… | 2015-07-01   | D      |        1 |   0.00002% |
| 1301 | quill_tab        | NVIDIA         | Jetson TX2 [Tablet], Jet… | Tegra X2 (T186)    | 2017-03-14   | O      |        1 |   0.00002% |
| 1301 | mt2              | Huawei         | Ascend Mate 2 4G          | Snapdragon 400 (M… | 2014-01-01   | D      |        1 |   0.00002% |
| 1301 | k11ta_a          | ulefone        | Future                    | Helio P10 (MT6755) | 2016-05-01   | U      |        1 |   0.00002% |
| 1301 | j7toplteskt      | Samsung        | Galaxy Wide3              | Exynos 7870        | 2018-05-01   | U      |        1 |   0.00002% |
| 1301 | find7s           | OPPO           | Find7                     | Snapdragon 801 (M… | 2014-03-01   | U      |        1 |   0.00002% |
| 1301 | e5lte            | Samsung        | Galaxy E5 (SM-E500F/M)    | Snapdragon 410     | 2015-01-01   | U      |        1 |   0.00002% |
| 1301 | d2refreshspr     | Samsung        | Galaxy S III (Sprint)     | Snapdragon S4 Plu… | 2012-06-01   | U      |        1 |   0.00002% |
| 1301 | a71n             | Samsung        | Galaxy A71                | Snapdragon 730     | 2020-01-01   | U      |        1 |   0.00002% |
| 1301 | RMX3461          | Realme         | 9 5G Speed Edition        | Snapdragon 778G    | 2022-03-01   | U      |        1 |   0.00002% |
| 1301 | Nightmare        |                |                           |                    |              | U      |        1 |   0.00002% |
|      | Unlisted         |                |                           |                    |              |        |     4850 |      0.11% |
|      | Total            |                |                           |                    |              |        |  4282950 |    100.00% |
---------------------------------------------------------------------------------------------------------------------------------------------

Status codes: O=active official build, D=discontinued official build, U=unofficial build

Manufacturers of devices that run LineageOS
---------------------------------------------------------------------
| Rank |     Maker      | Builds | % Builds | Installs | % Installs |
---------------------------------------------------------------------
| 1    | Samsung        |    408 |    31.1% |  1198273 |     27.98% |
| 2    | Motorola       |    100 |     7.6% |  1139448 |     26.60% |
| 3    | Xiaomi         |    204 |    15.5% |   734442 |     17.15% |
| 4    | OPPO           |     22 |     1.7% |   382503 |      8.93% |
| 5    | Huawei         |     31 |     2.4% |   261540 |      6.11% |
| 6    | virtual        |     12 |     0.9% |   178271 |      4.16% |
| 7    | LG             |     67 |     5.1% |    67668 |      1.58% |
| 8    | Realme         |     33 |     2.5% |    65621 |      1.53% |
| 9    | OnePlus        |     43 |     3.3% |    57287 |      1.34% |
| 10   | Google         |     52 |     4.0% |    49195 |      1.15% |
| 11   | Amazon         |     13 |     1.0% |    41265 |      0.96% |
| 12   | Nintendo       |      3 |     0.2% |    23202 |      0.54% |
| 13   | Sony           |     60 |     4.6% |    15184 |      0.35% |
| 14   | Raspberry Pi   |      3 |     0.2% |    14054 |      0.33% |
| 15   | Lenovo         |     36 |     2.7% |    12574 |      0.29% |
| 16   | ASUS           |     28 |     2.1% |     3852 |      0.09% |
| 17   | LeEco          |      4 |     0.3% |     3779 |      0.09% |
| 18   | Nubia          |     17 |     1.3% |     3617 |      0.08% |
| 19   | Fairphone      |      5 |     0.4% |     3248 |      0.08% |
| 20   | unknown        |     22 |     1.7% |     3094 |      0.07% |
| 21   | ZTE            |      9 |     0.7% |     2285 |      0.05% |
| 22   | HTC            |     21 |     1.6% |     2248 |      0.05% |
| 23   | Nokia          |      8 |     0.6% |     1769 |      0.04% |
| 24   | Nothing        |      5 |     0.4% |     1343 |      0.03% |
| 25   | NVIDIA         |     10 |     0.8% |     1193 |      0.03% |
| 26   | R36S           |      1 |    0.08% |     1167 |      0.03% |
| 27   | Smartisan      |      2 |     0.2% |     1148 |      0.03% |
| 28   | HardKernel     |      7 |     0.5% |     1026 |      0.02% |
| 29   | Essential      |      1 |    0.08% |     1021 |      0.02% |
| 30   | Meizu          |      3 |     0.2% |      808 |      0.02% |
| 31   | BQ             |     11 |     0.8% |      689 |      0.02% |
| 32   | Razer          |      2 |     0.2% |      617 |      0.01% |
| 33   | ZUK            |      3 |     0.2% |      503 |      0.01% |
| 34   | Infinix        |      6 |     0.5% |      387 |     0.009% |
| 35   | Wingtech       |      1 |    0.08% |      346 |     0.008% |
| 36   | Wileyfox       |      3 |     0.2% |      293 |     0.007% |
| 37   | F(x)tec        |      2 |     0.2% |      210 |     0.005% |
| 38   | Sharp          |      1 |    0.08% |      150 |     0.004% |
| 39   | TECNO          |      4 |     0.3% |      128 |     0.003% |
| 40   | Walmart        |      1 |    0.08% |      127 |     0.003% |
| 41   | FEITIAN        |      1 |    0.08% |      120 |     0.003% |
| 42   | Pantech        |      5 |     0.4% |      113 |     0.003% |
| 43   | Solana         |      1 |    0.08% |      110 |     0.003% |
| 44   | Banana Pi      |      2 |     0.2% |      108 |     0.003% |
| 45   | Iocean         |      1 |    0.08% |      103 |     0.002% |
| 46   | GPD            |      1 |    0.08% |       99 |     0.002% |
| 47   | General Mobile |      3 |     0.2% |       93 |     0.002% |
| 48   | SHIFT          |      1 |    0.08% |       88 |     0.002% |
| 49   | YU             |      4 |     0.3% |       83 |     0.002% |
| 50   | PowKiddy       |      1 |    0.08% |       80 |     0.002% |
| 51   | Chuwi          |      1 |    0.08% |       77 |     0.002% |
| 52   | Dynalink       |      1 |    0.08% |       75 |     0.002% |
| 53   | Nextbit        |      1 |    0.08% |       74 |     0.002% |
| 54   | Vsmart         |      1 |    0.08% |       73 |     0.002% |
| 55   | Retroid        |      1 |    0.08% |       55 |     0.001% |
| 56   | Radxa          |      3 |     0.2% |       50 |     0.001% |
| 57   | C Idea         |      1 |    0.08% |       44 |     0.001% |
| 58   | Yandex         |      1 |    0.08% |       40 |    0.0009% |
| 59   | Acer           |      1 |    0.08% |       38 |    0.0009% |
| 60   | Blackberry     |      1 |    0.08% |       33 |    0.0008% |
| 61   | Teracube       |      1 |    0.08% |       23 |    0.0005% |
| 62   | H96            |      2 |     0.2% |       21 |    0.0005% |
| 63   | Umidigi        |      1 |    0.08% |       11 |    0.0003% |
| 64   | JiaYu          |      1 |    0.08% |        8 |    0.0002% |
| 65   | 10.or          |      1 |    0.08% |        7 |    0.0002% |
| 66   | Volla Phone    |      1 |    0.08% |        5 |    0.0001% |
| 67   | Gionee         |      1 |    0.08% |        3 |   0.00007% |
| 68   | ARK            |      1 |    0.08% |        2 |   0.00005% |
| 69   | ulefone        |      1 |    0.08% |        1 |   0.00002% |
|      | Unlisted       |      ? |        ? |     4850 |      0.11% |
|      | Total          |   1313 |   100.0% |  4282950 |    100.00% |
---------------------------------------------------------------------

Processors of devices that run LineageOS
---------------------------------------------------------------------
| Rank | Processor Type | Builds | % Builds | Installs | % Installs |
---------------------------------------------------------------------
| 1    | Snapdragon 6   |    203 |    15.5% |  1029749 |     24.04% |
| 2    | Exynos         |    163 |    12.4% |  1003578 |     23.43% |
| 3    | Snapdragon 8   |    353 |    26.9% |   608185 |     14.20% |
| 4    | Snapdragon 4   |    183 |    13.9% |   493316 |     11.52% |
| 5    | Snapdragon 7   |     72 |     5.5% |   342708 |      8.00% |
| 6    | Kirin          |     21 |     1.6% |   197907 |      4.62% |
| 7    | X86            |      5 |     0.4% |   155672 |      3.63% |
| 8    | Helio          |     62 |     4.7% |   150359 |      3.51% |
| 9    | Omap           |     10 |     0.8% |    71667 |      1.67% |
| 10   | Dimensity      |     40 |     3.0% |    65817 |      1.54% |
| 11   | Mediatek       |     32 |     2.4% |    43710 |      1.02% |
| 12   | Tegra          |     21 |     1.6% |    28890 |      0.67% |
| 13   | Arm            |      1 |    0.08% |    19314 |      0.45% |
| 14   | Broadcom       |     11 |     0.8% |    15377 |      0.36% |
| 15   | Spreadtrum     |     15 |     1.1% |    12484 |      0.29% |
| 16   | Atom           |     11 |     0.8% |     9772 |      0.23% |
| 17   | Tensor         |     16 |     1.2% |     9305 |      0.22% |
| 18   | Snapdragon S   |     28 |     2.1% |     7689 |      0.18% |
| 19   | unknown        |     21 |     1.6% |     3119 |      0.07% |
| 20   | X86_64         |      5 |     0.4% |     2689 |      0.06% |
| 21   | Qualcomm       |      4 |     0.3% |     1678 |      0.04% |
| 22   | Rockchip       |      3 |     0.2% |     1337 |      0.03% |
| 23   | Amlogic        |     15 |     1.1% |     1145 |      0.03% |
| 24   | Snapdragon 2   |     10 |     0.8% |      912 |      0.02% |
| 25   | Arm64          |      3 |     0.2% |      737 |      0.02% |
| 26   | Novathor       |      1 |    0.08% |      607 |      0.01% |
| 27   | Marvell        |      1 |    0.08% |      213 |     0.005% |
| 28   | Arm32          |      1 |    0.08% |       82 |     0.002% |
| 29   | Snapdragon     |      1 |    0.08% |       44 |     0.001% |
| 30   | Unisoc         |      1 |    0.08% |       38 |    0.0009% |
|      | Unlisted       |      ? |        ? |     4850 |      0.11% |
|      | Total          |   1313 |   100.0% |  4282950 |    100.00% |
---------------------------------------------------------------------

Status of LineageOS builds
--------------------------------------------------------------------------------------
|  Status  | Builds | % Builds | Installs | % Installs | Unsupported | % Unsupported |
--------------------------------------------------------------------------------------
| O        |    251 |    19.1% |  2038531 |     47.60% |     1493261 |        34.87% |
| D        |    301 |    22.9% |   430767 |     10.06% |             |               |
| U        |    761 |    58.0% |  1808802 |     42.23% |             |               |
| Unlisted |      ? |        ? |     4850 |      0.11% |             |               |
| Total    |   1313 |   100.0% |  4282950 |    100.00% |     1493261 |        34.87% |
--------------------------------------------------------------------------------------
Build status codes: O=active official, D=discontinued official, U=unofficial
Unsupported = installs of unsupported versions of official builds

LineageOS versions in active installs
---------------------------------------------------------------
| Rank | Version  | Builds | % Builds | Installs | % Installs |
---------------------------------------------------------------
| 1    | 18.1     |    591 |      45% |  1082861 |     25.28% |
| 2    | 21.0     |    539 |      41% |   980390 |     22.89% |
| 3    | 17.1     |    501 |      38% |   826809 |     19.30% |
| 4    | 20.0     |    527 |      40% |   475626 |     11.11% |
| 5    | 19.1     |    415 |      32% |   433973 |     10.13% |
| 6    | 22.2     |    444 |      34% |   156752 |      3.66% |
| 7    | 14.1     |    415 |      32% |    95801 |      2.24% |
| 8    | 15.1     |    289 |      22% |    71613 |      1.67% |
| 9    | 16.0     |    533 |      41% |    53089 |      1.24% |
| 10   | 23.0     |    278 |      21% |    36153 |      0.84% |
| 11   | 17.0     |     87 |       7% |    25048 |      0.58% |
| 12   | 22.1     |    336 |      26% |    13972 |      0.33% |
| 13   | 18.0     |     90 |       7% |     9953 |      0.23% |
| 14   | 13.0     |    148 |      11% |     8481 |      0.20% |
| 15   | 12.1     |      7 |     0.5% |     1905 |      0.04% |
| 16   | 22.0     |    118 |       9% |     1790 |      0.04% |
| 17   | 20.3     |      1 |    0.08% |     1789 |      0.04% |
| 18   | 19.0     |    115 |       9% |     1761 |      0.04% |
| 19   | 10.0     |     25 |       2% |      190 |     0.004% |
| 20   | 16.1     |      2 |     0.2% |       73 |     0.002% |
| 21   | 15.0     |      3 |     0.2% |       21 |    0.0005% |
| 22   | 20.2     |      2 |     0.2% |       19 |    0.0004% |
| 23   | 15.2     |      1 |    0.08% |       10 |    0.0002% |
| 24   | 24.0     |      1 |    0.08% |        9 |    0.0002% |
| 25   | 14.0     |      3 |     0.2% |        3 |   0.00007% |
| 26   | 17.9     |      1 |    0.08% |        2 |   0.00005% |
| 27   | 21.3     |      1 |    0.08% |        1 |   0.00002% |
|      | Unlisted |      ? |        ? |     4850 |      0.11% |
|      | Total    |   1313 |     100% |  4282950 |    100.00% |
---------------------------------------------------------------

Years when devices running LineageOS were released
-------------------------------------------------------------------
|   Year   |  Status  | Builds | % Builds | Installs | % Installs |
-------------------------------------------------------------------
| 1905     | O        |      0 |       0% |        0 |         0% |
| 1905     | D        |      0 |       0% |        0 |         0% |
| 1905     | U        |      1 |    0.08% |       23 |    0.0005% |
| 1905     | Total    |      1 |    0.08% |       23 |    0.0005% |
| 2011     | O        |      0 |       0% |        0 |         0% |
| 2011     | D        |      5 |     0.4% |      597 |      0.01% |
| 2011     | U        |      4 |     0.3% |      252 |     0.006% |
| 2011     | Total    |      9 |     0.7% |      849 |      0.02% |
| 2012     | O        |      0 |       0% |        0 |         0% |
| 2012     | D        |     16 |     1.2% |    12505 |      0.29% |
| 2012     | U        |     14 |     1.1% |    85168 |      1.99% |
| 2012     | Total    |     30 |     2.3% |    97673 |      2.28% |
| 2013     | O        |      0 |       0% |        0 |         0% |
| 2013     | D        |     45 |     3.4% |    31635 |      0.74% |
| 2013     | U        |     41 |     3.1% |    15117 |      0.35% |
| 2013     | Total    |     86 |     6.5% |    46752 |      1.09% |
| 2014     | O        |      0 |       0% |        0 |         0% |
| 2014     | D        |     64 |     4.9% |    26784 |      0.63% |
| 2014     | U        |     79 |     6.0% |    42170 |      0.98% |
| 2014     | Total    |    143 |    10.9% |    68954 |      1.61% |
| 2015     | O        |      2 |     0.2% |      581 |      0.01% |
| 2015     | D        |     55 |     4.2% |    45814 |      1.07% |
| 2015     | U        |     79 |     6.0% |    29481 |      0.69% |
| 2015     | Total    |    136 |    10.4% |    75876 |      1.77% |
| 2016     | O        |      6 |     0.5% |    16255 |      0.38% |
| 2016     | D        |     49 |     3.7% |   218801 |      5.11% |
| 2016     | U        |     71 |     5.4% |   168747 |      3.94% |
| 2016     | Total    |    126 |     9.6% |   403803 |      9.43% |
| 2017     | O        |     18 |     1.4% |   137502 |      3.21% |
| 2017     | D        |     18 |     1.4% |    29774 |      0.70% |
| 2017     | U        |     77 |     5.9% |   358803 |      8.38% |
| 2017     | Total    |    113 |     8.6% |   526079 |     12.28% |
| 2018     | O        |     33 |     2.5% |   361464 |      8.44% |
| 2018     | D        |     26 |     2.0% |    33294 |      0.78% |
| 2018     | U        |     57 |     4.3% |   439643 |     10.26% |
| 2018     | Total    |    116 |     8.8% |   834401 |     19.48% |
| 2019     | O        |     44 |     3.4% |  1286358 |     30.03% |
| 2019     | D        |     12 |     0.9% |    21577 |      0.50% |
| 2019     | U        |     70 |     5.3% |   383385 |      8.95% |
| 2019     | Total    |    126 |     9.6% |  1691320 |     39.49% |
| 2020     | O        |     45 |     3.4% |   169671 |      3.96% |
| 2020     | D        |     10 |     0.8% |     9914 |      0.23% |
| 2020     | U        |     59 |     4.5% |    78184 |      1.83% |
| 2020     | Total    |    114 |     8.7% |   257769 |      6.02% |
| 2021     | O        |     39 |     3.0% |    40043 |      0.93% |
| 2021     | D        |      1 |    0.08% |       72 |     0.002% |
| 2021     | U        |     47 |     3.6% |   175308 |      4.09% |
| 2021     | Total    |     87 |     6.6% |   215423 |      5.03% |
| 2022     | O        |     31 |     2.4% |    11795 |      0.28% |
| 2022     | D        |      0 |       0% |        0 |         0% |
| 2022     | U        |     51 |     3.9% |     6864 |      0.16% |
| 2022     | Total    |     82 |     6.2% |    18659 |      0.44% |
| 2023     | O        |     22 |     1.7% |    11622 |      0.27% |
| 2023     | D        |      0 |       0% |        0 |         0% |
| 2023     | U        |     48 |     3.7% |     9846 |      0.23% |
| 2023     | Total    |     70 |     5.3% |    21468 |      0.50% |
| 2024     | O        |      9 |     0.7% |     3008 |      0.07% |
| 2024     | D        |      0 |       0% |        0 |         0% |
| 2024     | U        |     20 |     1.5% |     1982 |      0.05% |
| 2024     | Total    |     29 |     2.2% |     4990 |      0.12% |
| 2025     | O        |      2 |     0.2% |      232 |     0.005% |
| 2025     | D        |      0 |       0% |        0 |         0% |
| 2025     | U        |     10 |     0.8% |     2156 |      0.05% |
| 2025     | Total    |     12 |     0.9% |     2388 |      0.06% |
| unknown  | U        |     33 |     2.5% |    11673 |      0.27% |
| unknown  | Total    |     33 |     2.5% |    11673 |      0.27% |
| Unlisted | Unlisted |      ? |        ? |     4850 |      0.11% |
| Total    | Total    |   1313 |     100% |  4282950 |       100% |
-------------------------------------------------------------------

Reported on Tuesday 11 Nov 2025 17:05:20 -04.
Script execution time = 22 minutes 17 seconds
```
