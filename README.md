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
2. Install the php-mbstring extension.
3. Download this script from https://github.com/amosbatto/lineageos_stats
   If the ZIP file was downloaded, then decompress it. 
  
In a Debian/Ubuntu/Mint terminal, these commands should work: 
```
sudo apt install php php-mbstring
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
-c , --country   Display the country list.   
                 Ex: php lineageos_stats.php -c  
                   
-cXX             Can specify an optional two letter country code or a
--country=XX     country name to display stats for a single country.  
                 Ex: php lineageos_stats.php -cUS  
                 Ex: php lineageos_stats.php --country=BR  
                 Ex: php lineageos_stats.php -c"United Arab Emirates"  
                   
-b , --build     Display the build list.  
                 Ex: php lineageos_stats.php -b  
                   
-bCODENAME       Can specify a build codename or a device model name to  
--build=CODENAME display stats for a single build.  
                 Ex: php lineageos_stats.php -blavender  
                 Ex: php lineageos_stats.php --build=lavender  
                 Ex: php lineageos_stats.php -b"Xiaomi Redmi Note 7"  
                 Ex: php lineageos_stats.php --build="nOtE 7"  
                 The search is case insensitive and can find partial   
                 strings.
                                                                        
-sSEP             The field separator for tables, which can be any 
--separator=SEP   string and is " | " by default. It is recommended to 
                  set to "\t" (tab) if copying into a spreadsheet and
                  to ',' (comma) or ';' (semicolon) if copying into a
                  a CSV (comma separated value) file.
                  Ex: php lineageos_stats.php -s"\t"                   
                  Ex: php lineageos_stats.php -separator="; "                             
                  
-v , --verbose   Show information about what countries are being  
                 downloaded and what builds were found. Recommended 
                 for progress on how script is progressing when 
                 getting the build list.  
```

**Author:**  Amos Batto (amosbatto[AT]yahoo.com, https://amosbbatto.wordpress.com)  
**License:** MIT license (for the lineageos_stats script and the included 
         SimpleHtmlDom https://sourceforge.net/projects/simplehtmldom)  
**Last update:**    2025-10-28 (version 0.3)  

----------------

For people who don't what to install and run this script on their own
computers, here is the output of the script:

```
$ php lineageos_stats.php
Countries by number of LineageOS installs
---------------------------------------------------------------------------------------------
| Rank |   CC    |        Country         | Installs | % Installs | Installs/M | Pop. (000) |
---------------------------------------------------------------------------------------------
| 1    | BR      | Brazil                 |  1875584 |     43.60% |       8813 |  212812.41 |
| 2    | CN      | China                  |  1307420 |     30.39% |        923 | 1416096.09 |
| 3    | US      | United States          |   307177 |      7.14% |        885 |  347275.81 |
| 4    | Unknown |                        |   242220 |      5.63% |            |            |
| 5    | VN      | Viet Nam               |    89538 |      2.08% |        881 |  101598.53 |
| 6    | DE      | Germany                |    42915 |      1.00% |        510 |   84075.08 |
| 7    | ID      | Indonesia              |    42529 |      0.99% |        149 |  285721.24 |
| 8    | RU      | Russian Federation     |    33168 |      0.77% |        230 |  143997.39 |
| 9    | UA      | Ukraine                |    32694 |      0.76% |        839 |   38980.38 |
| 10   | IN      | India                  |    25891 |      0.60% |         18 | 1463865.53 |
| 11   | KR      | South Korea            |    24637 |      0.57% |        477 |   51667.03 |
| 12   | FR      | France                 |    19481 |      0.45% |        292 |   66650.80 |
| 13   | GB      | United Kingdom         |    14156 |      0.33% |        204 |   69551.33 |
| 14   | ES      | Spain                  |    12807 |      0.30% |        267 |   47889.96 |
| 15   | IT      | Italy                  |    12477 |      0.29% |        211 |   59146.26 |
| 16   | TR      | Turkey                 |    11116 |      0.26% |        127 |   87685.43 |
| 17   | TH      | Thailand               |    10871 |      0.25% |        152 |   71619.86 |
| 18   | PL      | Poland                 |    10800 |      0.25% |        283 |   38140.91 |
| 19   | EG      | Egypt                  |    10514 |      0.24% |         89 |  118366.00 |
| 20   | KG      | Kyrgyzstan             |     8867 |      0.21% |       1215 |    7295.03 |
| 21   | KH      | Cambodia               |     8633 |      0.20% |        484 |   17847.98 |
| 22   | JP      | Japan                  |     8145 |      0.19% |         66 |  123103.48 |
| 23   | MX      | Mexico                 |     7654 |      0.18% |         58 |  131946.90 |
| 24   | NL      | Netherlands            |     6888 |      0.16% |        375 |   18346.82 |
| 25   | CA      | Canada                 |     6716 |      0.16% |        167 |   40126.72 |
| 26   | BD      | Bangladesh             |     4719 |      0.11% |         27 |  175686.90 |
| 27   | IQ      | Iraq                   |     4608 |      0.11% |         98 |   47020.77 |
| 28   | IR      | Iran                   |     4445 |      0.10% |         48 |   92417.68 |
| 29   | AR      | Argentina              |     4281 |      0.10% |         93 |   45851.38 |
| 30   | PK      | Pakistan               |     3880 |      0.09% |         15 |  255219.55 |
| 31   | TW      | Taiwan                 |     3675 |      0.09% |        159 |   23112.79 |
| 32   | PH      | Philippines            |     3625 |      0.08% |         31 |  116786.96 |
| 33   | CO      | Colombia               |     3294 |      0.08% |         62 |   53425.64 |
| 34   | MA      | Morocco                |     3230 |      0.08% |         84 |   38430.77 |
| 35   | AU      | Australia              |     3076 |      0.07% |        114 |   26974.03 |
| 36   | MY      | Malaysia               |     2939 |      0.07% |         82 |   35977.84 |
| 37   | DZ      | Algeria                |     2797 |      0.07% |         59 |   47435.31 |
| 38   | AT      | Austria                |     2737 |      0.06% |        300 |    9113.57 |
| 39   | CZ      | Czech Republic         |     2734 |      0.06% |        258 |   10609.24 |
| 40   | RO      | Romania                |     2727 |      0.06% |        144 |   18908.65 |
| 41   | PT      | Portugal               |     2642 |      0.06% |        254 |   10411.83 |
| 42   | CH      | Switzerland            |     2412 |      0.06% |        269 |    8967.41 |
| 43   | LA      | Laos                   |     2346 |      0.05% |        298 |    7873.05 |
| 44   | SE      | Sweden                 |     2336 |      0.05% |        219 |   10656.63 |
| 45   | SY      | Syrian Arab Republic   |     2328 |      0.05% |         91 |   25620.43 |
| 46   | HU      | Hungary                |     2254 |      0.05% |        234 |    9632.29 |
| 47   | BY      | Belarus                |     2176 |      0.05% |        242 |    8997.60 |
| 48   | NG      | Nigeria                |     2090 |      0.05% |          9 |  237527.78 |
| 49   | PE      | Peru                   |     1938 |      0.05% |         56 |   34576.67 |
| 50   | BE      | Belgium                |     1902 |      0.04% |        162 |   11758.60 |
| 51   | CL      | Chile                  |     1838 |      0.04% |         93 |   19859.92 |
| 52   | GR      | Greece                 |     1791 |      0.04% |        180 |    9938.84 |
| 53   | FI      | Finland                |     1789 |      0.04% |        318 |    5623.33 |
| 54   | AE      | United Arab Emirates   |     1750 |      0.04% |        154 |   11346.00 |
| 55   | HK      | Hong Kong              |     1694 |      0.04% |        229 |    7396.08 |
| 56   | SA      | Saudi Arabia           |     1457 |      0.03% |         42 |   34566.33 |
| 57   | GH      | Ghana                  |     1415 |      0.03% |         40 |   35064.27 |
| 58   | IL      | Israel                 |     1407 |      0.03% |        148 |    9517.18 |
| 59   | VE      | Venezuela              |     1326 |      0.03% |         46 |   28516.90 |
| 60   | MM      | Myanmar                |     1251 |      0.03% |         23 |   54850.65 |
| 61   | SK      | Slovakia               |     1237 |      0.03% |        226 |    5474.88 |
| 62   | KZ      | Kazakhstan             |     1235 |      0.03% |         59 |   20843.75 |
| 63   | OM      | Oman                   |     1204 |      0.03% |        219 |    5494.69 |
| 64   | BG      | Bulgaria               |     1194 |      0.03% |        178 |    6714.56 |
| 65   | ZA      | South Africa           |     1191 |      0.03% |         18 |   64747.32 |
| 66   | RS      | Serbia                 |     1179 |      0.03% |        176 |    6689.04 |
| 67   | EC      | Ecuador                |     1073 |      0.02% |         59 |   18289.90 |
| 68   | MG      | Madagascar             |     1029 |      0.02% |         31 |   32740.68 |
| 69   | BO      | Bolivia                |      999 |      0.02% |         79 |   12581.84 |
| 70   | LK      | Sri Lanka              |      979 |      0.02% |         42 |   23229.47 |
| 71   | NP      | Nepal                  |      961 |      0.02% |         32 |   29618.12 |
| 72   | KE      | Kenya                  |      958 |      0.02% |         17 |   57532.49 |
| 73   | NZ      | New Zealand            |      943 |      0.02% |        180 |    5251.90 |
| 74   | CM      | Cameroon               |      912 |      0.02% |         31 |   29879.34 |
| 75   | DK      | Denmark                |      896 |      0.02% |        149 |    6002.51 |
| 76   | SV      | El Salvador            |      880 |      0.02% |        138 |    6365.50 |
| 77   | NO      | Norway                 |      877 |      0.02% |        156 |    5623.07 |
| 78   | LT      | Lithuania              |      864 |      0.02% |        305 |    2830.14 |
| 79   | JO      | Jordan                 |      788 |      0.02% |         68 |   11520.68 |
| 80   | UZ      | Uzbekistan             |      760 |      0.02% |         21 |   37053.43 |
| 81   | SG      | Singapore              |      745 |      0.02% |        127 |    5870.75 |
| 82   | AZ      | Azerbaijan             |      715 |      0.02% |         69 |   10397.71 |
| 83   | IE      | Ireland                |      687 |      0.02% |        129 |    5308.04 |
| 84   | HR      | Croatia                |      650 |      0.02% |        169 |    3848.16 |
| 85   | BA      | Bosnia and Herzegovina |      641 |      0.01% |        204 |    3140.10 |
| 86   | MD      | Moldova                |      562 |      0.01% |        188 |    2996.11 |
| 87   | DO      | Dominican Republic     |      533 |      0.01% |         46 |   11520.49 |
| 88   | ET      | Ethiopia               |      518 |      0.01% |          4 |  135472.05 |
| 89   | ZM      | Zambia                 |      493 |      0.01% |         22 |   21913.87 |
| 90   | EE      | Estonia                |      480 |      0.01% |        357 |    1344.23 |
| 91   | SI      | Slovenia               |      469 |      0.01% |        222 |    2117.07 |
| 92   | TN      | Tunisia                |      454 |      0.01% |         37 |   12348.57 |
| 93   | TG      | Togo                   |      425 |     0.010% |         44 |    9721.61 |
| 94   | ML      | Mali                   |      424 |     0.010% |         17 |   25198.82 |
| 95   | GE      | Georgia                |      414 |     0.010% |        109 |    3806.67 |
| 96   | LV      | Latvia                 |      387 |     0.009% |        209 |    1853.56 |
| 97   | UG      | Uganda                 |      381 |     0.009% |          7 |   51384.89 |
| 98   | PY      | Paraguay               |      350 |     0.008% |         50 |    7013.08 |
| 99   | CI      | Côte d'Ivoire          |      347 |     0.008% |         11 |   32711.55 |
| 100  | UY      | Uruguay                |      338 |     0.008% |        100 |    3384.69 |
| 101  | YE      | Yemen                  |      324 |     0.008% |          8 |   41773.88 |
| 101  | CU      | Cuba                   |      324 |     0.008% |         30 |   10937.20 |
| 103  | SN      | Senegal                |      319 |     0.007% |         17 |   18931.97 |
| 104  | CR      | Costa Rica             |      309 |     0.007% |         60 |    5152.95 |
| 105  | AM      | Armenia                |      269 |     0.006% |         91 |    2952.37 |
| 106  | GT      | Guatemala              |      268 |     0.006% |         14 |   18687.88 |
| 107  | AO      | Angola                 |      251 |     0.006% |          6 |   39040.04 |
| 108  | BJ      | Benin                  |      235 |     0.005% |         16 |   14814.46 |
| 109  | CD      | Congo, Democratic Rep… |      228 |     0.005% |          2 |  112832.47 |
| 110  | AL      | Albania                |      219 |     0.005% |         79 |    2771.51 |
| 111  | HN      | Honduras               |      198 |     0.005% |         18 |   11005.85 |
| 112  | TZ      | Tanzania               |      183 |     0.004% |          3 |   70546.00 |
| 113  | AF      | Afghanistan            |      177 |     0.004% |          4 |   43844.11 |
| 114  | PA      | Panama                 |      175 |     0.004% |         38 |    4571.19 |
| 114  | LB      | Lebanon                |      175 |     0.004% |         30 |    5849.42 |
| 114  | JM      | Jamaica                |      175 |     0.004% |         62 |    2837.08 |
| 117  | MK      | Macedonia              |      172 |     0.004% |         95 |    1813.79 |
| 118  | QA      | Qatar                  |      159 |     0.004% |         51 |    3115.89 |
| 119  | BH      | Bahrain                |      157 |     0.004% |         96 |    1643.33 |
| 120  | CY      | Cyprus                 |      156 |     0.004% |        114 |    1370.75 |
| 121  | NI      | Nicaragua              |      155 |     0.004% |         22 |    7007.50 |
| 122  | ZW      | Zimbabwe               |      154 |     0.004% |          9 |   16950.80 |
| 123  | RE      | Réunion                |      146 |     0.003% |        165 |     882.41 |
| 124  | LY      | Libya                  |      143 |     0.003% |         19 |    7458.56 |
| 125  | TJ      | Tajikistan             |      134 |     0.003% |         12 |   10786.73 |
| 126  | LU      | Luxembourg             |      133 |     0.003% |        195 |     680.45 |
| 126  | KW      | Kuwait                 |      133 |     0.003% |         26 |    5026.08 |
| 128  | MZ      | Mozambique             |      123 |     0.003% |          3 |   35631.65 |
| 129  | GM      | Gambia                 |      120 |     0.003% |         43 |    2822.09 |
| 130  | MW      | Malawi                 |      118 |     0.003% |          5 |   22216.12 |
| 131  | TT      | Trinidad and Tobago    |       88 |     0.002% |         58 |    1511.16 |
| 132  | SL      | Sierra Leone           |       84 |     0.002% |         10 |    8819.79 |
| 133  | IS      | Iceland                |       83 |     0.002% |        208 |     398.27 |
| 134  | MT      | Malta                  |       82 |     0.002% |        150 |     545.41 |
| 135  | BF      | Burkina Faso           |       81 |     0.002% |          3 |   24074.58 |
| 136  | ME      | Montenegro             |       77 |     0.002% |        122 |     632.73 |
| 137  | MN      | Mongolia               |       73 |     0.002% |         21 |    3517.10 |
| 138  | MV      | Maldives               |       68 |     0.002% |        128 |     529.68 |
| 139  | PG      | Papua New Guinea       |       65 |     0.002% |          6 |   10762.82 |
| 139  | CG      | Congo                  |       65 |     0.002% |         10 |    6484.44 |
| 141  | SD      | Sudan                  |       63 |     0.001% |          1 |   51662.15 |
| 141  | MU      | Mauritius              |       63 |     0.001% |         50 |    1268.28 |
| 143  | RW      | Rwanda                 |       60 |     0.001% |          4 |   14569.34 |
| 144  | GN      | Guinea                 |       59 |     0.001% |          4 |   15099.73 |
| 145  | TM      | Turkmenistan           |       54 |     0.001% |          7 |    7618.85 |
| 145  | SB      | Solomon Islands        |       54 |     0.001% |         64 |     838.65 |
| 147  | MC      | Monaco                 |       53 |     0.001% |       1382 |      38.34 |
| 148  | BN      | Brunei Darussalam      |       48 |     0.001% |        103 |     466.33 |
| 149  | MO      | Macao                  |       47 |     0.001% |         65 |     722.00 |
| 150  | GP      | Guadeloupe             |       46 |     0.001% |        123 |     373.79 |
| 151  | HT      | Haiti                  |       44 |     0.001% |          4 |   11906.10 |
| 152  | NA      | Namibia                |       40 |    0.0009% |         13 |    3092.82 |
| 153  | ER      | Eritrea                |       39 |    0.0009% |         11 |    3607.00 |
| 154  | PR      | Puerto Rico            |       34 |    0.0008% |         11 |    3235.29 |
| 155  | NE      | Niger                  |       30 |    0.0007% |          1 |   27917.83 |
| 155  | BZ      | Belize                 |       30 |    0.0007% |         71 |     422.92 |
| 157  | AD      | Andorra                |       29 |    0.0007% |        350 |      82.90 |
| 158  | MR      | Mauritania             |       26 |    0.0006% |          5 |    5315.07 |
| 159  | SR      | Suriname               |       25 |    0.0006% |         39 |     639.85 |
| 159  | LR      | Liberia                |       25 |    0.0006% |          4 |    5731.21 |
| 159  | GA      | Gabon                  |       25 |    0.0006% |         10 |    2593.13 |
| 159  | BW      | Botswana               |       25 |    0.0006% |         10 |    2562.12 |
| 163  | SO      | Somalia                |       24 |    0.0006% |          1 |   19654.74 |
| 164  | KP      | North Korea            |       22 |    0.0005% |        0.8 |   26571.00 |
| 165  | BI      | Burundi                |       20 |    0.0005% |          1 |   14390.00 |
| 166  | CV      | Cape Verde             |       19 |    0.0004% |         36 |     527.33 |
| 167  | XK      | Kosovo                 |       18 |    0.0004% |         11 |    1674.13 |
| 168  | KM      | Comoros                |       17 |    0.0004% |         19 |     882.85 |
| 169  | GY      | Guyana                 |       16 |    0.0004% |         19 |     835.99 |
| 169  | FJ      | Fiji                   |       16 |    0.0004% |         17 |     933.15 |
| 171  | LI      | Liechtenstein          |       15 |    0.0003% |        374 |      40.13 |
| 172  | TD      | Chad                   |       14 |    0.0003% |        0.7 |   21003.71 |
| 173  | CW      | Curaçao                |       13 |    0.0003% |         70 |     185.49 |
| 174  | VA      | Vatican City           |       11 |    0.0003% |      22000 |       0.50 |
| 174  | NC      | New Caledonia          |       11 |    0.0003% |         37 |     295.33 |
| 176  | PF      | French Polynesia       |       10 |    0.0002% |         35 |     282.47 |
| 176  | GW      | Guinea-Bissau          |       10 |    0.0002% |          4 |    2249.52 |
| 178  | BB      | Barbados               |        8 |    0.0002% |         28 |     282.62 |
| 179  | FO      | Faroe Islands          |        7 |    0.0002% |        125 |      56.00 |
| 179  | DJ      | Djibouti               |        7 |    0.0002% |          6 |    1184.08 |
| 179  | BT      | Bhutan                 |        7 |    0.0002% |          9 |     796.68 |
| 182  | GL      | Greenland              |        6 |    0.0001% |        108 |      55.75 |
| 182  | CF      | Central African Repub… |        6 |    0.0001% |          1 |    5513.28 |
| 182  | BS      | Bahamas                |        6 |    0.0001% |         15 |     403.03 |
| 185  | VC      | Saint Vincent and the… |        5 |    0.0001% |         50 |      99.92 |
| 185  | SZ      | Eswatini               |        5 |    0.0001% |          4 |    1256.17 |
| 185  | ST      | Sao Tome and Principe  |        5 |    0.0001% |         21 |     240.25 |
| 185  | SS      | South Sudan            |        5 |    0.0001% |        0.4 |   12188.79 |
| 189  | TL      | Timor-Leste            |        4 |   0.00009% |          3 |    1418.52 |
| 189  | SC      | Seychelles             |        4 |   0.00009% |         30 |     132.78 |
| 189  | PS      | Palestine, State of    |        4 |   0.00009% |        0.7 |    5589.62 |
| 189  | GU      | Guam                   |        4 |   0.00009% |         24 |     169.00 |
| 189  | GQ      | Equatorial Guinea      |        4 |   0.00009% |          2 |    1938.43 |
| 189  | AW      | Aruba                  |        4 |   0.00009% |         37 |     108.15 |
| 195  | SM      | San Marino             |        3 |   0.00007% |         89 |      33.57 |
| 195  | NN      | Sint Maarten (Dutch p… |        3 |   0.00007% |         68 |      43.92 |
| 195  | LC      | Saint Lucia            |        3 |   0.00007% |         17 |     180.15 |
| 195  | KY      | Cayman Islands         |        3 |   0.00007% |         40 |      75.84 |
| 195  | GI      | Gibraltar              |        3 |   0.00007% |         75 |      40.13 |
| 195  | EH      | Western Sahara         |        3 |   0.00007% |          5 |     600.90 |
| 195  | EA      |                        |        3 |   0.00007% |            |            |
| 195  | DM      | Dominica               |        3 |   0.00007% |         46 |      65.87 |
| 195  | AS      | American Samoa         |        3 |   0.00007% |         65 |      46.03 |
| 195  | AI      | Anguilla               |        3 |   0.00007% |        204 |      14.73 |
| 205  | LS      | Lesotho                |        2 |   0.00005% |        0.8 |    2363.33 |
| 205  | GD      | Grenada                |        2 |   0.00005% |         17 |     117.30 |
| 205  | AG      | Antigua and Barbuda    |        2 |   0.00005% |         21 |      94.21 |
| 208  | WS      | Samoa                  |        1 |   0.00002% |          5 |     219.31 |
| 208  | TO      | Tonga                  |        1 |   0.00002% |         10 |     103.74 |
| 208  | PW      | Palau                  |        1 |   0.00002% |         57 |      17.66 |
| 208  | NF      | Norfolk Island         |        1 |   0.00002% |            |            |
| 208  | KI      | Kiribati               |        1 |   0.00002% |          7 |     136.49 |
| 208  | IO      | British Indian Ocean … |        1 |   0.00002% |         25 |      39.73 |
| 208  | FK      | Falkland Islands (Mal… |        1 |   0.00002% |        288 |       3.47 |
|      | World   | World                  |  4301866 |       100% |        523 | 8231613.07 |
---------------------------------------------------------------------------------------------

Downloading builds from http://stats.lineageos.org. Press 'b' to break downloads.

LineageOS builds by number of installs
---------------------------------------------------------------------------------------------------------------------------------------------
| Rank |      Build       |     Maker      |           Model           |     Processor      | Mod.Released | Status | Installs | % Installs |
---------------------------------------------------------------------------------------------------------------------------------------------
| 1    | channel          | Motorola       | moto g7 play              | Snapdragon 632     | 2019-03-01   | O      |   357746 |      8.32% |
| 2    | dipper           | Xiaomi         | Mi 8                      | Snapdragon 845     | 2018-07-01   | O      |   326653 |      7.59% |
| 3    | lake             | Motorola       | moto g7 plus              | Snapdragon 636     | 2019-02-01   | O      |   179900 |      4.18% |
| 4    | jeter            | Motorola       | moto g6 play              | Snapdragon 430     | 2018-05-01   | U      |   175070 |      4.07% |
| 5    | ocean            | Motorola       | moto g7 power             | Snapdragon 632     | 2019-02-01   | O      |   165761 |      3.85% |
| 6    | beyond0lte       | Samsung        | Galaxy S10e               | Exynos 9820        | 2019-03-08   | O      |   152983 |      3.56% |
| 7    | waydroid_x86_64  | virtual        | Waydroid on x86_64        | x86                | 2021-07-01   | U      |   148275 |      3.45% |
| 8    | beyond1lte       | Samsung        | Galaxy S10                | Exynos 9820        | 2019-03-08   | O      |   146453 |      3.40% |
| 9    | OP4AA7           | OPPO           | K5                        | Snapdragon 730G    | 2019-10-01   | U      |   126419 |      2.94% |
| 10   | sanders          | Motorola       | Moto G5S Plus             | Snapdragon 625     | 2017-08-01   | U      |   122665 |      2.85% |
| 11   | beyond2lte       | Samsung        | Galaxy S10+               | Exynos 9825        | 2019-08-23   | O      |   114591 |      2.66% |
| 12   | hero2lte         | Samsung        | Galaxy S7 Edge            | Exynos 8890        | 2016-03-18   | D      |   106788 |      2.48% |
| 13   | greatlte         | Samsung        | Galaxy Note 8             | Exynos 8895        | 2017-09-01   | U      |   101884 |      2.37% |
| 14   | herolte          | Samsung        | Galaxy S7                 | Exynos 8890        | 2016-03-18   | D      |    96391 |      2.24% |
| 15   | sagit            | Xiaomi         | Mi 6                      | Snapdragon 835     | 2017-04-01   | O      |    90632 |      2.11% |
| 16   | a71              | Samsung        | Galaxy A71                | Snapdragon 730     | 2020-01-17   | O      |    79365 |      1.84% |
| 17   | ugg              | Xiaomi         | Redmi Note 5A Prime, Red… | Snapdragon 435     | 2017-11-01   | U      |    64563 |      1.50% |
| 18   | A57              | OPPO           | A57 (2016)                | Snapdragon 435     | 2016-12-01   | U      |    64386 |      1.50% |
| 19   | HWPAR            | Huawei         | Nova 3                    | Kirin 970          | 2018-08-01   | U      |    63474 |      1.48% |
| 20   | RMX2201CN        | Realme         | V3 5G                     | Dimensity 720      | 2020-09-10   | U      |    63382 |      1.47% |
| 21   | R9               | OPPO           | R9                        | Helio P10          | 2016-03-01   | U      |    63180 |      1.47% |
| 22   | HWMAR            | Huawei         | P30 Lite                  | Kirin 710          | 2019-04-25   | U      |    63159 |      1.47% |
| 23   | PACM00           | OPPO           | R15 10                    | Helio P60          | 2018-04-01   | U      |    63085 |      1.47% |
| 24   | HWSEA-A          | Huawei         | Nova 5 Pro                | Kirin 980          | 2019-06-01   | U      |    63054 |      1.47% |
| 25   | prada            | LG             | Prada 3.0                 | OMAP 4430          | 2012-01-01   | U      |    63021 |      1.46% |
| 26   | HWDUB-Q          | Huawei         | Y7 Prime 2019             | Snapdragon 450     | 2019-01-01   | U      |    62564 |      1.45% |
| 27   | PBDM00           | OPPO           | R17 Pro / RX17 Pro        | Snapdragon 710     | 2018-11-01   | U      |    62339 |      1.45% |
| 28   | troika           | Motorola       | one action                | Exynos 9609        | 2019-10-31   | O      |    46883 |      1.09% |
| 29   | miatoll          | Xiaomi         | POCO M2 Pro, Redmi Note … | Snapdragon 720G    | 2020-07-14   | O      |    33914 |      0.79% |
| 30   | j8y18lte         | Samsung        | J8 (2018)                 | Snapdragon 450     | 2018-07-01   | U      |    27480 |      0.64% |
| 31   | kane             | Motorola       | one vision, p50           | Exynos 9609        | 2019-05-15   | O      |    27359 |      0.64% |
| 32   | zerofltexx       | Samsung        | Galaxy S6                 | Exynos 7420        | 2015-04-01   | D      |    27230 |      0.63% |
| 33   | river            | Motorola       | moto g7                   | Snapdragon 632     | 2019-02-01   | O      |    24959 |      0.58% |
| 34   | a20              | Samsung        | Galaxy A20                | Exynos 7884        | 2019-04-05   | U      |    24654 |      0.57% |
| 35   | nx_tab           | Nintendo       | Switch v1 [Tablet], Swit… | Tegra X1 (T210)    | 2017-03-03   | O      |    22059 |      0.51% |
| 36   | waydroid_arm64   | virtual        | Waydroid on ARM64         | ARM                | 2021-07-01   | U      |    17538 |      0.41% |
| 37   | tiffany          | Xiaomi         | Mi 5X                     | Snapdragon 625     | 2017-09-01   | U      |    17500 |      0.41% |
| 38   | karnak           | Amazon         | Fire HD 8                 | MediaTek MT8163    | 2018-10-04   | U      |    16374 |      0.38% |
| 39   | matissewifi      | Samsung        | Galaxy Tab 4 10.1 Wi-Fi   | Snapdragon 400     | 2014-06-01   | U      |    14144 |      0.33% |
| 40   | apollon          | Xiaomi         | Mi 10T, Mi 10T Pro, Redm… | Snapdragon 865     | 2020-10-01   | O      |    13496 |      0.31% |
| 41   | lavender         | Xiaomi         | Redmi Note 7              | Snapdragon 660     | 2019-01-01   | D      |    12908 |      0.30% |
| 42   | a70q             | Samsung        | Galaxy A70 (SM-A705)      | Snapdragon 675     | 2019-05-01   | U      |    12612 |      0.29% |
| 43   | tissot           | Xiaomi         | Mi A1                     | Snapdragon 625     | 2017-10-01   | D      |    12179 |      0.28% |
| 44   | n8000            | Samsung        | Galaxy Note 10.1          | Exynos 4 Quad 4412 | 2012-08-01   | U      |    10412 |      0.24% |
| 45   | j6primelte       | Samsung        | Galaxy J6+                | Snapdragon 425     | 2018-09-25   | U      |    10300 |      0.24% |
| 46   | dumpling         | OnePlus        | OnePlus 5T                | Snapdragon 835     | 2017-11-01   | O      |     9858 |      0.23% |
| 47   | on7xelte         | Samsung        | Galaxy J7 Prime           | Exynos 7870        | 2016-09-01   | U      |     8832 |      0.21% |
| 48   | p10              | Huawei         | P10                       | Kirin 960          | 2017-03-01   | U      |     8813 |      0.20% |
| 49   | gemini           | Xiaomi         | Mi 5                      | Snapdragon 820     | 2016-04-01   | O      |     8481 |      0.20% |
| 50   | gtel3g           | Samsung        | Galaxy Tab E              | Spreadtrum SC7730S | 2015-07-01   | U      |     8451 |      0.20% |
| 51   | rpi4             | Raspberry Pi   | Raspberry Pi 4            | Broadcom BCM2711   | 2019-06-24   | U      |     8042 |      0.19% |
| 52   | Mi439            | Xiaomi         | Redmi 7A, Redmi 8, Redmi… | Snapdragon 439     | 2019-05-28   | O      |     8017 |      0.19% |
| 53   | n8010            | Samsung        | Galaxy Note 10.1 (N8010)  | Exynos 4 Quad 4412 | 2012-08-01   | U      |     7963 |      0.19% |
| 54   | a30              | Samsung        | Galaxy A30                | Exynos 7904        | 2019-03-01   | U      |     7463 |      0.17% |
| 55   | mustang          | Amazon         | Fire 7 (2019)             | Mediatek MT8163    | 2019-06-06   | U      |     7182 |      0.17% |
| 56   | whyred           | Xiaomi         | Redmi Note 5 Pro          | Snapdragon 636     | 2018-02-01   | D      |     6825 |      0.16% |
| 57   | j4primelte       | Samsung        | Galaxy J4+                | Snapdragon 425     | 2018-10-01   | U      |     6699 |      0.16% |
| 58   | espresso3g       | Samsung        | Galaxy Tab 2 7.0 (GSM), … | OMAP 4430          | 2012-04-01   | D      |     6627 |      0.15% |
| 59   | douglas          | Amazon         | Fire HD 8 (2017)          | MediaTek MT8163    | 2017-06-01   | U      |     6577 |      0.15% |
| 60   | ford             | Amazon         | Fire 7" (ford)            | MediaTek MT8127    | 2015-11-01   | U      |     6512 |      0.15% |
| 61   | crownlte         | Samsung        | Galaxy Note 9             | Exynos 9810        | 2018-08-09   | D      |     6413 |      0.15% |
| 62   | santos10wifi     | Samsung        | Galaxy Tab III 10.1       | Atom Z2560         | 2013-07-07   | U      |     6401 |      0.15% |
| 63   | gtaxlwifi        | Samsung        | Galaxy Tab A 10.1" (2016) | Exynos 7870 Octa   | 2016-05-01   | U      |     6397 |      0.15% |
| 64   | sweet            | Xiaomi         | Redmi Note 10 Pro, Redmi… | Snapdragon 732G    | 2021-03-01   | O      |     6298 |      0.15% |
| 65   | Mi8937           | Xiaomi         | Redmi 3S, Redmi 3X, Redm… | Snapdragon 430     | 2016-06-14   | O      |     5868 |      0.14% |
| 66   | starlte          | Samsung        | Galaxy S9                 | Exynos 9810        | 2018-03-11   | D      |     5724 |      0.13% |
| 67   | TB8703           | Lenovo         | TAB 3 8 Plus              | Snapdragon 625     | 2017-03-01   | U      |     5646 |      0.13% |
| 68   | core33g          | Samsung        | Galaxy Core Prime (SM-G3… | Snapdragon 410     | 2014-11-01   | U      |     5614 |      0.13% |
| 69   | ginkgo           | Xiaomi         | Redmi Note 8, Redmi Note… | Snapdragon 665     | 2019-08-01   | O      |     5589 |      0.13% |
| 70   | star2lte         | Samsung        | Galaxy S9+                | Exynos 9810        | 2018-03-11   | D      |     5250 |      0.12% |
| 71   | beryllium        | Xiaomi         | POCO F1                   | Snapdragon 845     | 2018-08-01   | O      |     5197 |      0.12% |
| 72   | alioth           | Xiaomi         | POCO F3, Redmi K40, Mi 1… | Snapdragon 870     | 2021-03-01   | O      |     5057 |      0.12% |
| 73   | enchilada        | OnePlus        | OnePlus 6                 | Snapdragon 845     | 2018-04-01   | O      |     4979 |      0.12% |
| 74   | a5y17lte         | Samsung        | Galaxy A5 (2017)          | Exynos 7880        | 2017-01-02   | D      |     4921 |      0.11% |
| 75   | fajita           | OnePlus        | OnePlus 6T, OnePlus 6T (… | Snapdragon 845     | 2018-11-01   | O      |     4896 |      0.11% |
| 76   | m20lte           | Samsung        | Galaxy M20                | Exynos 7904        | 2019-01-28   | D      |     4887 |      0.11% |
| 77   | rpi5             | Raspberry Pi   | Raspberry Pi 5            | Broadcom BCM2712   | 2023-10-23   | U      |     4738 |      0.11% |
| 78   | klte             | Samsung        | Galaxy S5 LTE (G900F/M/R… | Snapdragon 801     | 2014-04-11   | D      |     4715 |      0.11% |
| 79   | n1awifi          | Samsung        | Galaxy Note 10.1 Wi-Fi (… | Exynos 5420        | 2013-10-10   | D      |     4602 |      0.11% |
| 80   | j7elte           | Samsung        | Galaxy J7 (2015)          | Exynos 7580        | 2015-06-01   | D      |     4405 |      0.10% |
| 81   | cheeseburger     | OnePlus        | OnePlus 5                 | Snapdragon 835     | 2017-06-01   | O      |     4403 |      0.10% |
| 82   | clover           | Xiaomi         | Xiaomi Mi Pad 4           | Snapdragon 660     | 2018-06-25   | U      |     4401 |      0.10% |
| 83   | mido             | Xiaomi         | Redmi Note 4              | Snapdragon 625     | 2017-01-01   | D      |     4256 |      0.10% |
| 84   | r8q              | Samsung        | Galaxy S20 FE, Galaxy S2… | Snapdragon 865     | 2021-04-23   | O      |     4249 |      0.10% |
| 85   | coral            | Google         | Pixel 4 XL                | Snapdragon 855     | 2019-09-01   | O      |     4179 |      0.10% |
| 86   | sunfish          | Google         | Pixel 4a                  | Snapdragon 730G    | 2020-08-01   | O      |     3977 |      0.09% |
| 87   | montana          | Motorola       | moto g5s                  | Snapdragon 430     | 2017-08-01   | D      |     3962 |      0.09% |
| 88   | blueline         | Google         | Pixel 3                   | Snapdragon 845     | 2018-10-01   | O      |     3938 |      0.09% |
| 89   | harpia           | Motorola       | moto g4 play              | Snapdragon 410     | 2016-05-01   | D      |     3937 |      0.09% |
| 90   | gtexslte         | Samsung        | Galaxy Tab A 7.0 LTE (20… | Snapdragon 410     | 2016-03-01   | U      |     3922 |      0.09% |
| 91   | hlte             | Samsung        | Galaxy Note 3 LTE (N9005… | Snapdragon 800     | 2013-09-01   | D      |     3806 |      0.09% |
| 92   | mocha            | Xiaomi         | Mi Pad 1                  | Tegra K1 (T124)    | 2014-06-01   | U      |     3771 |      0.09% |
| 93   | blossom          | Xiaomi         | Redmi 9A, Redmi 9C, Redm… | Helio G25 / G35    | 2020-07-07   | U      |     3744 |      0.09% |
| 94   | austin           | Amazon         | Fire 7" (Austin)          | MediaTek MT8127    | 2017-06-01   | U      |     3554 |      0.08% |
| 95   | rosemary         | Xiaomi         | Redmi Note 10S, Redmi No… | Helio G95          | 2021-04-01   | O      |     3517 |      0.08% |
| 96   | santos103g       | Samsung        | Galaxy Tab III 10.1       | Atom Z2560         | 2013-07-07   | U      |     3491 |      0.08% |
| 97   | wayne            | Xiaomi         | Mi 6X                     | Snapdragon 660     | 2018-04-01   | D      |     3456 |      0.08% |
| 98   | espressowifi     | Samsung        | Galaxy Tab 2 7.0 (Wi-Fi … | OMAP 4430          | 2012-05-01   | D      |     3441 |      0.08% |
| 99   | flo              | Google         | Nexus 7 (Wi-Fi, 2013 ver… | Snapdragon S4 Pro  | 2013-07-26   | D      |     3427 |      0.08% |
| 100  | evert            | Motorola       | moto g6 plus              | Snapdragon 630     | 2018-05-01   | O      |     3426 |      0.08% |
| 101  | instantnoodlep   | OnePlus        | OnePlus 8 Pro             | Snapdragon 865     | 2020-04-01   | O      |     3406 |      0.08% |
| 102  | chiron           | Xiaomi         | Mi MIX 2                  | Snapdragon 835     | 2017-09-01   | O      |     3385 |      0.08% |
| 103  | laurel_sprout    | Xiaomi         | Mi A3                     | Snapdragon 665     | 2019-07-01   | O      |     3371 |      0.08% |
| 104  | sargo            | Google         | Pixel 3a                  | Snapdragon 670     | 2019-04-01   | O      |     3326 |      0.08% |
| 105  | vayu             | Xiaomi         | POCO X3 Pro               | Snapdragon 860     | 2021-03-01   | O      |     3169 |      0.07% |
| 106  | guacamole        | OnePlus        | OnePlus 7 Pro, OnePlus 7… | Snapdragon 855     | 2019-05-01   | O      |     3036 |      0.07% |
| 107  | redfin           | Google         | Pixel 5                   | Snapdragon 765G 5G | 2020-10-01   | O      |     2971 |      0.07% |
| 108  | surya            | Xiaomi         | POCO X3 NFC               | Snapdragon 732G    | 2020-09-08   | O      |     2885 |      0.07% |
| 109  | kebab            | OnePlus        | OnePlus 8T, OnePlus 8T (… | Snapdragon 865     | 2020-10-01   | O      |     2842 |      0.07% |
| 110  | nx563j           | Nubia          | Z17                       | Snapdragon 835     | 2017-06-01   | O      |     2833 |      0.07% |
| 111  | gta4xlwifi       | Samsung        | Galaxy Tab S6 Lite (Wi-F… | Exynos 9611        | 2020-04-02   | O      |     2832 |      0.07% |
| 112  | n5100            | Samsung        | Galaxy Note 8.0 (GSM)     | Exynos 4412        | 2013-04-01   | D      |     2829 |      0.07% |
| 113  | lmi              | Xiaomi         | POCO F2 Pro, Redmi K30 P… | Snapdragon 865     | 2020-05-01   | O      |     2825 |      0.07% |
| 114  | gtaxllte         | Samsung        | Galaxy Tab A (SM-T580)    | Exynos 7870 Octa   | 2016-05-01   | U      |     2819 |      0.07% |
| 115  | potter           | Motorola       | Moto G5 Plus              | Snapdragon 625     | 2017-04-01   | U      |     2791 |      0.06% |
| 116  | chagallwifi      | Samsung        | Galaxy Tab S 10.5 Wi-Fi … | Exynos 5420        | 2014-07-01   | D      |     2741 |      0.06% |
| 117  | x2               | LeEco          | Le Max2                   | Snapdragon 820     | 2016-04-01   | D      |     2733 |      0.06% |
| 118  | onclite          | Xiaomi         | Redmi 7, Redmi Y3         | Snapdragon 632     | 2019-03-01   | O      |     2716 |      0.06% |
| 119  | viennalte        | Samsung        | Galaxy Note Pro 12.2      | Exynos 5420 Octa   | 2014-02-13   | U      |     2693 |      0.06% |
| 120  | merlinx          | Xiaomi         | Redmi Note 9              | Helio G85          | 2020-05-01   | D      |     2683 |      0.06% |
| 121  | chagalllte       | Samsung        | Galaxy Tab S 10.5 LTE     | Exynos 5420        | 2014-07-01   | D      |     2677 |      0.06% |
| 122  | A37              | OPPO           | A37, A37f, A37fw          | Snapdragon 410     | 2016-06-01   | U      |     2573 |      0.06% |
| 123  | gtexswifi        | Samsung        | Galaxy Tab A 7.0          | Spreadtrum SC8830  | 2016-03-01   | U      |     2563 |      0.06% |
| 124  | gts4lvwifi       | Samsung        | Galaxy Tab S5e (Wi-Fi)    | Snapdragon 670     | 2019-04-01   | O      |     2473 |      0.06% |
| 125  | matisse3g        | Samsung        | Galaxy Tab 4 10.1 3G      | Snapdragon 400     | 2014-06-01   | U      |     2431 |      0.06% |
| 126  | lemonade         | OnePlus        | OnePlus 9, OnePlus 9 (T-… | Snapdragon 888     | 2021-03-01   | O      |     2420 |      0.06% |
| 127  | a10              | Samsung        | Galaxy A10                | Exynos 7884        | 2019-03-01   | U      |     2404 |      0.06% |
| 128  | davinci          | Xiaomi         | Mi 9T, Redmi K20 (China)… | Snapdragon 730     | 2019-06-01   | O      |     2372 |      0.06% |
| 129  | x86_64_tv        | virtual        | Android TV on x86_64      | x86                |              | U      |     2319 |      0.05% |
| 130  | bacon            | OnePlus        | OnePlus One               | Snapdragon 801     | 2014-06-06   | D      |     2297 |      0.05% |
| 131  | R11              | OPPO           | R11                       | Snapdragon 660     | 2017-06-01   | U      |     2266 |      0.05% |
| 132  | lemonadep        | OnePlus        | OnePlus 9 Pro, OnePlus 9… | Snapdragon 888     | 2021-03-01   | O      |     2264 |      0.05% |
| 133  | oneplus3         | OnePlus        | OnePlus 3, OnePlus 3T     | Snapdragon 820     | 2016-06-01   | D      |     2237 |      0.05% |
| 134  | i9300            | Samsung        | Galaxy S III (Internatio… | Exynos 4412        | 2012-05-29   | D      |     2235 |      0.05% |
| 135  | mondrianwifi     | Samsung        | Galaxy Tab Pro 8.4        | Snapdragon 800     | 2014-01-01   | D      |     2150 |      0.05% |
| 136  | garden           | Xiaomi         | Redmi 9A, Redmi 9C        | Helio G25          | 2020-07-07   | U      |     2148 |      0.05% |
| 137  | star2qltechn     | Samsung        | Galaxy S9+                | Snapdragon 845     | 2018-03-16   | U      |     2099 |      0.05% |
| 138  | gts210vewifi     | Samsung        | Galaxy Tab S2 9.7 Wi-Fi … | Snapdragon 652     | 2016-08-01   | D      |     2045 |      0.05% |
| 139  | vince            | Xiaomi         | Redmi 5 Plus              | Snapdragon 625     | 2017-12-07   | U      |     2022 |      0.05% |
| 140  | j5xnlte          | Samsung        | Galaxy J5 (J510MN/GN/FN)  | Snapdragon 410     | 2016-04-01   | U      |     2006 |      0.05% |
| 141  | cactus           | Xiaomi         | Redmi 6A                  | Helio A22          | 2018-06-15   | U      |     2000 |      0.05% |
| 142  | matisselte       | Samsung        | Galaxy Tab 4 10.1 LTE     | Snapdragon 400     | 2014-05-01   | U      |     1989 |      0.05% |
| 143  | serranoltexx     | Samsung        | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |     1988 |      0.05% |
| 144  | taimen           | Google         | Pixel 2 XL                | Snapdragon 835     | 2017-10-01   | O      |     1962 |      0.05% |
| 145  | gta4lwifi        | Samsung        | Galaxy Tab A7 10.4 2020 … | Snapdragon 662     | 2020-09-01   | O      |     1937 |      0.05% |
| 146  | noblelte         | Samsung        | Galaxy Note 5             | Exynos 7420 Octa   | 2015-08-21   | U      |     1917 |      0.04% |
| 147  | n2awifi          | Samsung        | Galaxy Tab PRO 10.1       | Exynos 5420        | 2014-02-01   | D      |     1839 |      0.04% |
| 148  | android_x86_64   | virtual        | Android on x86_64         | x86                |              | U      |     1821 |      0.04% |
| 149  | polaris          | Xiaomi         | Mi MIX 2S                 | Snapdragon 845     | 2018-04-01   | O      |     1784 |      0.04% |
| 150  | umi              | Xiaomi         | Mi 10                     | Snapdragon 865     | 2020-02-01   | O      |     1781 |      0.04% |
| 150  | lisa             | Xiaomi         | Xiaomi 11 Lite 5G NE, Xi… | Snapdragon 778G 5G | 2021-09-01   | O      |     1781 |      0.04% |
| 152  | walleye          | Google         | Pixel 2                   | Snapdragon 835     | 2017-10-01   | O      |     1778 |      0.04% |
| 153  | hotdogb          | OnePlus        | OnePlus 7T, OnePlus 7T (… | Snapdragon 855+    | 2019-09-01   | O      |     1761 |      0.04% |
| 154  | treltexx         | Samsung        | Galaxy Note 4             | Exynos 5433 Octa   | 2014-10-01   | U      |     1755 |      0.04% |
| 155  | a7y17lte         | Samsung        | Galaxy A7 (2017)          | Exynos 7880        | 2017-01-02   | D      |     1753 |      0.04% |
| 156  | instantnoodle    | OnePlus        | OnePlus 8, OnePlus 8 (T-… | Snapdragon 865     | 2020-04-01   | O      |     1750 |      0.04% |
| 157  | crosshatch       | Google         | Pixel 3 XL                | Snapdragon 845     | 2018-10-01   | O      |     1737 |      0.04% |
| 158  | lancelot         | Xiaomi         | Redmi 9                   | Helio G85          | 2020-06-01   | D      |     1732 |      0.04% |
| 159  | X00TD            | ASUS           | Zenfone Max Pro M1        | Snapdragon 636     | 2018-05-01   | D      |     1703 |      0.04% |
| 160  | hammerhead       | Google         | Nexus 5                   | Snapdragon 800     | 2013-10-31   | D      |     1690 |      0.04% |
| 161  | a52sxq           | Samsung        | Galaxy A52s 5G            | Snapdragon 778G 5G | 2021-09-01   | O      |     1669 |      0.04% |
| 162  | tulip            | ZTE            | Axon 7 Mini               | Snapdragon 617     | 2016-09-01   | D      |     1661 |      0.04% |
| 163  | renoir           | Xiaomi         | Mi 11 Lite 5G             | Snapdragon 780G 5G | 2021-03-01   | O      |     1657 |      0.04% |
| 164  | y2s              | Samsung        | Galaxy S20+, Galaxy S20+… | Exynos 990         | 2020-03-06   | U      |     1656 |      0.04% |
| 165  | avicii           | OnePlus        | OnePlus Nord              | Snapdragon 765G    | 2020-07-21   | D      |     1654 |      0.04% |
| 166  | beyondx          | Samsung        | Galaxy S10 5G             | Exynos 9820        | 2019-03-08   | O      |     1591 |      0.04% |
| 167  | a5xelte          | Samsung        | Galaxy A5 (2016)          | Exynos 7580        | 2015-12-01   | D      |     1572 |      0.04% |
| 168  | a6lte            | Samsung        | Galaxy A6 (Exynos7870)    | Exynos 7870        | 2018-05-01   | U      |     1554 |      0.04% |
| 169  | flox             | Google         | Nexus 7 2013 (Wi-Fi, Rep… | Snapdragon S4 Pro  | 2013-07-26   | D      |     1540 |      0.04% |
| 170  | gta4l            | Samsung        | Galaxy Tab A7 10.4 2020 … | Snapdragon 662     | 2020-09-01   | O      |     1539 |      0.04% |
| 171  | a21s             | Samsung        | Galaxy A21s               | Exynos 850         | 2020-06-02   | O      |     1530 |      0.04% |
| 172  | suez             | Amazon         | Fire HD 10                | MediaTek MT8173    | 2017-06-01   | U      |     1525 |      0.04% |
| 173  | starqltechn      | Samsung        | Galaxy S9                 | Snapdragon 845     | 2018-03-16   | U      |     1515 |      0.04% |
| 174  | kenzo            | Xiaomi         | Redmi Note 3              | Snapdragon 650     | 2016-02-01   | D      |     1509 |      0.04% |
| 175  | libra            | Xiaomi         | Mi 4c                     | Snapdragon 808     | 2015-09-01   | D      |     1508 |      0.04% |
| 176  | grandppltedx     | Samsung        | Galaxy J2 Prime / Grand … | MediaTek MT6737T   | 2016-11-01   | U      |     1498 |      0.03% |
| 177  | bonito           | Google         | Pixel 3a XL               | Snapdragon 670     | 2019-04-01   | O      |     1496 |      0.03% |
| 178  | cedric           | Motorola       | moto g5                   | Snapdragon 430     | 2017-03-01   | D      |     1447 |      0.03% |
| 179  | jfltexx          | Samsung        | Galaxy S4 (GT-I9505, SGH… | Snapdragon 600     | 2013-04-01   | D      |     1444 |      0.03% |
| 180  | marble           | Xiaomi         | POCO F5 (Global), POCO F… | Snapdragon 7+ Gen… | 2023-05-09   | O      |     1435 |      0.03% |
| 181  | helium           | Xiaomi         | Mi Max                    | Snapdragon 652     | 2016-05-01   | U      |     1429 |      0.03% |
| 182  | a3xelte          | Samsung        | Galaxy A3 (2016)          | Exynos 7578        | 2015-12-01   | D      |     1406 |      0.03% |
| 183  | ms013g           | Samsung        | Galaxy Grand 2 Duos       | Snapdragon 400     | 2013-11-25   | D      |     1391 |      0.03% |
| 184  | bluejay          | Google         | Pixel 6a                  | Tensor GS101       | 2022-07-01   | O      |     1363 |      0.03% |
| 185  | n7100            | Samsung        | Galaxy Note II            | Exynos 4412 Quad   | 2012-10-01   | U      |     1349 |      0.03% |
| 186  | gts4lv           | Samsung        | Galaxy Tab S5e (LTE)      | Snapdragon 670     | 2019-04-01   | O      |     1321 |      0.03% |
| 187  | TBX704           | Lenovo         | Tab 4 10 Plus             | Snapdragon? 625    | 2017-07-01   | U      |     1317 |      0.03% |
| 188  | deen             | Motorola       | One                       | Snapdragon 625     | 2020-07-02   | U      |     1311 |      0.03% |
| 189  | certus           | Xiaomi         | Redmi 6 / 6A              | Helio A22          | 2018-06-01   | U      |     1305 |      0.03% |
| 190  | D22AP            | virtual        | Android 12 (API 22)       |                    |              | U      |     1297 |      0.03% |
| 191  | gt58wifi         | Samsung        | Tab A 2015 8.0 (SM-T350)  | Snapdragon 410     | 2015-05-01   | U      |     1292 |      0.03% |
| 192  | grus             | Xiaomi         | Mi 9 SE                   | Snapdragon 712     | 2019-02-01   | O      |     1274 |      0.03% |
| 192  | gauguin          | Xiaomi         | Mi 10T Lite 5G, Mi 10i 5… | Snapdragon 750G 5G | 2020-10-01   | O      |     1274 |      0.03% |
| 194  | tokay            | Google         | Pixel 9                   | Tensor G4          | 2024-08-22   | O      |     1267 |      0.03% |
| 195  | v1awifi          | Samsung        | Galaxy Note Pro 12.2 Wi-… | Exynos 5420        | 2014-02-01   | D      |     1222 |      0.03% |
| 196  | waydroid_x86     | virtual        | Waydroid on i386          | x86                | 2021-07-01   | U      |     1207 |      0.03% |
| 197  | FP3              | Fairphone      | Fairphone 3, Fairphone 3+ | Snapdragon 632     | 2019-09-01   | O      |     1192 |      0.03% |
| 198  | a7y18lte         | Samsung        | Galaxy A7 (2018)          | Exynos 7 Octa 7885 | 2018-10-01   | U      |     1191 |      0.03% |
| 199  | a52q             | Samsung        | Galaxy A52 4G             | Snapdragon 720G    | 2021-03-26   | O      |     1188 |      0.03% |
| 200  | r36s             | R36S           | R36S with Panel 4         | Rockchip RK3326    | 2025-05-31   | U      |     1180 |      0.03% |
| 201  | fogos            | Motorola       | moto g34 5G, moto g45 5G  | Snapdragon 695     | 2023-12-29   | O      |     1178 |      0.03% |
| 202  | flame            | Google         | Pixel 4                   | Snapdragon 855     | 2019-09-01   | O      |     1176 |      0.03% |
| 203  | klimtwifi        | Samsung        | Galaxy Tab S 8.4 Wi-Fi    | Exynos 5420        | 2014-07-01   | D      |     1165 |      0.03% |
| 204  | pioneer          | Sony           | Xperia XA2                | Snapdragon 630     | 2018-02-01   | O      |     1161 |      0.03% |
| 205  | oneplus2         | OnePlus        | OnePlus 2                 | Snapdragon 810     | 2015-08-28   | D      |     1158 |      0.03% |
| 206  | xmsirius         | Xiaomi         | Mi 8 SE                   | Snapdragon 710     | 2018-06-01   | D      |     1138 |      0.03% |
| 207  | j5lte            | Samsung        | Galaxy J5 (2015)          | Snapdragon 410     | 2015-06-26   | U      |     1135 |      0.03% |
| 208  | rpi3             | Raspberry Pi   | Raspberry Pi 3            | Broadcom BCM2837   | 2016-02-29   | U      |     1128 |      0.03% |
| 209  | violet           | Xiaomi         | Redmi Note 7 Pro          | Snapdragon 675     | 2019-03-13   | O      |     1124 |      0.03% |
| 210  | waydroid_tv_x86… | virtual        |                           | X86_64             |              | U      |     1119 |      0.03% |
| 211  | lt01wifi         | Samsung        | Galaxy Tab 3 8.0 (SM-T31… | Exynos 4 Dual 4212 | 2013-07-01   | U      |     1103 |      0.03% |
| 212  | lilac            | Sony           | Xperia XZ1 Compact        | Snapdragon 835     | 2017-10-01   | U      |     1095 |      0.03% |
| 213  | n8013            | Samsung        | Galaxy Note 10.1 WiFi     | Exynos 4412        | 2012-08-01   | U      |     1094 |      0.03% |
| 214  | merlin           | Motorola       | moto g3 turbo             | Snapdragon 615     | 2015-11-01   | D      |     1088 |      0.03% |
| 215  | n5110            | Samsung        | Galaxy Note 8.0 (Wi-Fi)   | Exynos 4412        | 2013-04-01   | D      |     1080 |      0.03% |
| 216  | nx               | Nintendo       | Switch v1 [Android TV], … | Tegra X1 (T210)    | 2017-03-03   | O      |     1071 |      0.02% |
| 217  | devon            | Motorola       | moto g32                  | Snapdragon 680 4G  | 2022-08-01   | O      |     1064 |      0.02% |
| 218  | hydrogen         | Xiaomi         | Mi Max                    | Snapdragon 650     | 2016-05-01   | D      |     1058 |      0.02% |
| 219  | FP4              | Fairphone      | Fairphone 4               | Snapdragon 750G    | 2021-10-01   | O      |     1050 |      0.02% |
| 220  | daisy            | Xiaomi         | Mi A2 Lite                | Snapdragon 625     | 2018-07-01   | U      |     1023 |      0.02% |
| 221  | mata             | Essential      | PH-1                      | Snapdragon 835     | 2017-08-01   | O      |     1019 |      0.02% |
| 222  | ysl              | Xiaomi         | Redmi S2, Redmi Y2        | Snapdragon 625     | 2018-05-01   | U      |     1018 |      0.02% |
| 223  | guacamoleb       | OnePlus        | OnePlus 7                 | Snapdragon 855     | 2019-05-01   | O      |     1017 |      0.02% |
| 224  | hltekor          | Samsung        | Galaxy Note 3 LTE (N900K… | Snapdragon 800     | 2013-09-01   | D      |     1014 |      0.02% |
| 225  | bangkk           | Motorola       | moto g84 5G               | Snapdragon 695     | 2023-09-08   | O      |      995 |      0.02% |
| 226  | armani           | Xiaomi         | Redmi 1S                  | Snapdragon 400     | 2014-05-01   | D      |      990 |      0.02% |
| 227  | gts3lwifi        | Samsung        | Galaxy Tab S3 WiFi        | Snapdragon 820     | 2017-03-24   | U      |      982 |      0.02% |
| 228  | gt510wifi        | Samsung        | Tab A 2015 9.7 SM-T550    | Snapdragon 410     | 2015-05-01   | U      |      974 |      0.02% |
| 229  | d2s              | Samsung        | Galaxy Note10+            | Exynos 9825        | 2019-08-23   | O      |      966 |      0.02% |
| 230  | lynx             | Google         | Pixel 7a                  | Tensor GS201       | 2023-05-10   | O      |      959 |      0.02% |
| 231  | panther          | Google         | Pixel 7                   | Tensor GS201       | 2022-10-13   | O      |      950 |      0.02% |
| 231  | klimtlte         | Samsung        | Galaxy Tab S 10.5 LTE (S… | Exynos 5 Octa 5420 | 2014-07-01   | U      |      950 |      0.02% |
| 233  | Mi8937_4_19      | Xiaomi         | Redmi 4X                  | Snapdragon 435     | 2017-02-28   | U      |      947 |      0.02% |
| 234  | ha3g             | Samsung        | Galaxy Note 3 (Internati… | Exynos 5420        | 2013-09-01   | D      |      945 |      0.02% |
| 235  | bramble          | Google         | Pixel 4a 5G               | Snapdragon 765G    | 2020-10-01   | O      |      942 |      0.02% |
| 236  | Mi8917           | Xiaomi         | Redmi 4A, Redmi 5A, Redm… | Snapdragon 425     | 2016-11-04   | O      |      938 |      0.02% |
| 237  | android_x86      | virtual        | Android on x86            | x86                |              | U      |      936 |      0.02% |
| 238  | payton           | Motorola       | moto x4                   | Snapdragon 630     | 2017-10-01   | O      |      935 |      0.02% |
| 239  | xz2c             | Sony           | Xperia XZ2 Compact        | Snapdragon 845     | 2018-04-01   | O      |      932 |      0.02% |
| 240  | joan             | LG             | V30 (Unlocked), V30 (T-M… | Snapdragon 835     | 2017-08-01   | O      |      926 |      0.02% |
| 241  | fog              | Xiaomi         | Redmi 10C                 | Snapdragon 680 4G  | 2022-03-23   | U      |      913 |      0.02% |
| 242  | rhode            | Motorola       | moto g52                  | Snapdragon 680 4G  | 2022-04-01   | O      |      904 |      0.02% |
| 242  | gta4xlveu        | Samsung        | Galaxy Tab S6 Lite        | Snapdragon 732G o… | 2022-05-23   | U      |      904 |      0.02% |
| 244  | n8020            | Samsung        | Galaxy Note 10.1 (N8020)  | Exynos 4 Quad 4412 | 2012-12-01   | U      |      894 |      0.02% |
| 245  | peridot          | Xiaomi         | Poco F6, Redmi Turbo 3    | Snapdragon 8s Gen… | 2024-05-23   | U      |      892 |      0.02% |
| 246  | gts210ltexx      | Samsung        | Galaxy Tab S2 9.7 (LTE)   | Exynos 5433        | 2015-09-01   | D      |      884 |      0.02% |
| 247  | gts28vewifi      | Samsung        | Galaxy Tab S2 8.0 Wi-Fi … | Snapdragon 652     | 2015-09-01   | D      |      879 |      0.02% |
| 248  | gts210wifi       | Samsung        | Galaxy Tab S2 9.7 (Wi-Fi) | Exynos 5433        | 2015-09-01   | D      |      872 |      0.02% |
| 249  | oriole           | Google         | Pixel 6                   | Tensor GS101       | 2021-10-19   | O      |      869 |      0.02% |
| 250  | pyxis            | Xiaomi         | Mi CC 9, Mi 9 Lite        | Snapdragon 665     | 2019-07-01   | O      |      863 |      0.02% |
| 251  | s2               | LeEco          | Le 2                      | Snapdragon 652     | 2016-04-01   | D      |      859 |      0.02% |
| 252  | grandneove3g     | Samsung        | Galaxy Grand Neo Plus     | Spreadtrum SC8830  | 2015-01-01   | U      |      855 |      0.02% |
| 253  | PL2              | Nokia          | Nokia 6.1 (2018)          | Snapdragon 630     | 2018-05-06   | O      |      850 |      0.02% |
| 254  | larry            | OnePlus        | OnePlus Nord CE 3 Lite 5… | Snapdragon 695     | 2023-04-11   | O      |      849 |      0.02% |
| 255  | rosy             | Xiaomi         | Redmi 5                   | Snapdragon 450     | 2017-12-01   | U      |      845 |      0.02% |
| 255  | gtanotexlwifi    | Samsung        | Galaxy Tab A 10.1 S Pen … | Exynos 7870 Octa   | 2016-10-01   | U      |      845 |      0.02% |
| 257  | guamp            | Motorola       | moto g9 play, moto g9, K… | Snapdragon 662     | 2020-08-01   | O      |      843 |      0.02% |
| 258  | gtowifi          | Samsung        | Galaxy Tab A 8.0 (2019)   | Snapdragon 429     | 2019-07-01   | O      |      838 |      0.02% |
| 259  | bullhead         | Google         | Nexus 5X                  | Snapdragon 808     | 2015-09-29   | D      |      828 |      0.02% |
| 260  | s5neolte         | Samsung        | Galaxy S5 Neo             | Exynos 7580        | 2015-08-01   | D      |      826 |      0.02% |
| 261  | osprey           | Motorola       | moto g (2015)             | Snapdragon 410     | 2015-07-01   | D      |      818 |      0.02% |
| 262  | a51              | Samsung        | Galaxy A51 (SM-A515F)     | Exynos 9611        | 2019-12-16   | U      |      817 |      0.02% |
| 263  | spes             | Xiaomi         | Redmi Note 11             | Snapdragon 680     | 2022-02-09   | U      |      816 |      0.02% |
| 264  | lt03lte          | Samsung        | Galaxy Note 10.1 2014 (L… | Snapdragon 800     | 2013-10-01   | D      |      811 |      0.02% |
| 265  | shamu            | Google         | Nexus 6                   | Snapdragon 805     | 2014-10-29   | D      |      807 |      0.02% |
| 266  | YTX703F          | Lenovo         | Yoga Tab 3 Plus Wi-Fi     | Snapdragon 652     | 2016-12-01   | D      |      798 |      0.02% |
| 267  | sofiar           | Motorola       | G8 Power                  | Snapdragon 665     | 2020-04-16   | U      |      797 |      0.02% |
| 268  | trlte            | Samsung        | Galaxy Note 4 (SM-N910F/… | Snapdragon 805     | 2014-10-01   | U      |      793 |      0.02% |
| 269  | kiev             | Motorola       | moto g 5G, moto one 5G a… | Snapdragon 750G    | 2020-05-01   | O      |      787 |      0.02% |
| 270  | cepheus          | Xiaomi         | Mi 9                      | Snapdragon 855     | 2019-03-25   | U      |      786 |      0.02% |
| 271  | jasmine_sprout   | Xiaomi         | Mi A2                     | Snapdragon 660     | 2018-07-01   | D      |      785 |      0.02% |
| 271  | ginna            | Motorola       | Moto E (2020)             | Snapdragon 632     | 2020-06-10   | U      |      785 |      0.02% |
| 273  | gtelwifiue       | Samsung        | Galaxy Tab E 9.6 (WiFi)   | Snapdragon 410     | 2015-07-01   | D      |      784 |      0.02% |
| 274  | j2y18lte         | Samsung        | Galaxy J2 2018            | Snapdragon 425     | 2018-01-01   | U      |      782 |      0.02% |
| 275  | gts3llte         | Samsung        | Galaxy Tab S3 9.7 LTE (S… | Snapdragon 820     | 2017-04-01   | U      |      774 |      0.02% |
| 276  | jason            | Xiaomi         | Mi Note 3                 | Snapdragon 660     | 2017-09-01   | D      |      770 |      0.02% |
| 277  | nash             | Motorola       | moto z2 force, moto z (2… | Snapdragon 835     | 2017-07-01   | O      |      758 |      0.02% |
| 278  | fortuna3g        | Samsung        | Galaxy Grand Prime (SM-S… | Snapdragon 410     | 2014-10-01   | U      |      753 |      0.02% |
| 279  | earth            | Xiaomi         | Redmi 12C, Redmi 12C NFC… | Helio G85          | 2023-01-01   | O      |      751 |      0.02% |
| 280  | thor             | Xiaomi         | Xiaomi 12S Ultra          | Snapdragon 8+ Gen1 | 2022-07-09   | O      |      745 |      0.02% |
| 281  | marlin           | Google         | Pixel XL                  | Snapdragon 821     | 2016-10-01   | O      |      743 |      0.02% |
| 282  | x86_64           |                | x86 64bits                | x86_64             |              | U      |      734 |      0.02% |
| 282  | ali              | Motorola       | Moto G6, Moto 1S          | Snapdragon 450     | 2018-04-01   | U      |      734 |      0.02% |
| 284  | natrium          | Xiaomi         | Mi 5s Plus                | Snapdragon 821     | 2016-10-01   | O      |      729 |      0.02% |
| 284  | milletwifi       | Samsung        | Galaxy Tab 4 8.0 Wi-Fi    | Snapdragon 400     | 2014-06-01   | U      |      729 |      0.02% |
| 286  | chime            | Xiaomi         | Redmi 9T, Redmi 9 Power,… | Snapdragon 662     | 2021-01-18   | U      |      728 |      0.02% |
| 287  | hotdog           | OnePlus        | OnePlus 7T Pro            | Snapdragon 855+    | 2019-10-01   | O      |      722 |      0.02% |
| 287  | begonia          | Xiaomi         | Redmi Note 8 Pro          | Helio G90T         | 2019-09-01   | U      |      722 |      0.02% |
| 289  | sailfish         | Google         | Pixel                     | Snapdragon 821     | 2016-10-01   | O      |      701 |      0.02% |
| 290  | platina          | Xiaomi         | Mi 8 Lite                 | Snapdragon 660     | 2018-09-01   | D      |      699 |      0.02% |
| 291  | m1721            | Meizu          | M6 Note (m1721)           | Snapdragon 625     | 2017-09-01   | U      |      692 |      0.02% |
| 292  | gta4xl           | Samsung        | Galaxy Tab S6 Lite (LTE)  | Exynos 9611        | 2020-04-02   | O      |      686 |      0.02% |
| 293  | hermes           | Xiaomi         | Redmi Note 2              | Helio X10          | 2015-08-14   | U      |      684 |      0.02% |
| 294  | FP5              | Fairphone      | Fairphone 5               | Qualcomm QCM6490   | 2023-08-01   | O      |      683 |      0.02% |
| 295  | santoni          | Xiaomi         | Redmi 4(X)                | Snapdragon 435     | 2017-05-01   | D      |      681 |      0.02% |
| 296  | zeroflte         | Samsung        | Galaxy S6 (SM-G920F)      | Exynos 7420 Octa … | 2015-04-01   | U      |      680 |      0.02% |
| 297  | fogo             | Motorola       | moto g 5G - 2024          | Snapdragon 765G    | 2020-05-01   | O      |      676 |      0.02% |
| 298  | j7xelte          | Samsung        | J7 (2016) (J710F)         | Exynos 7870        | 2016-04-01   | U      |      674 |      0.02% |
| 299  | falcon           | Motorola       | moto g                    | Snapdragon 400     | 2013-11-01   | D      |      673 |      0.02% |
| 300  | m8               | HTC            | One (M8)                  | Snapdragon 801     | 2014-03-01   | D      |      669 |      0.02% |
| 300  | aries            | Xiaomi         | Mi 2                      | Snapdragon S4 Pro  | 2012-11-01   | U      |      669 |      0.02% |
| 302  | rova             | Xiaomi         | Redmi 4A, Redmi 5A        | Snapdragon 425     | 2016-11-01   | U      |      667 |      0.02% |
| 303  | Spacewar         | Nothing        | Phone (1)                 | Snapdragon 778G+ … | 2022-07-12   | O      |      663 |      0.02% |
| 304  | caprip           | Motorola       | moto g30, K13 Pro         | Snapdragon 662     | 2021-03-01   | O      |      659 |      0.02% |
| 305  | federer          | Huawei         | MediaPad T2 10.0 Pro      | Snapdragon 615     | 2016-09-01   | U      |      655 |      0.02% |
| 306  | dubai            | Motorola       | edge 30                   | Snapdragon 778G+ … | 2022-05-01   | O      |      651 |      0.02% |
| 307  | x1s              | Samsung        | Galaxy S20, Galaxy S20 5G | Exynos 990         | 2020-03-06   | U      |      645 |      0.01% |
| 308  | j3xlte           | Samsung        | Galaxy J3 (2016) (SM-J32… | Spreadtrum SC9830A | 2016-05-06   | U      |      644 |      0.01% |
| 309  | osborn           |                |                           |                    |              | U      |      643 |      0.01% |
| 310  | gracerlte        | Samsung        | Galaxy Note FE, Galaxy N… | Exynos 8890 (14nm) | 2016-08-19   | U      |      642 |      0.01% |
| 311  | n1a3g            | Samsung        | Galaxy Note 10.1 (2014) … | Exynos 5420        | 2013-10-01   | U      |      641 |      0.01% |
| 312  | munch            | Xiaomi         | POCO F4, Redmi K40S       | Snapdragon 870     | 2022-06-01   | O      |      639 |      0.01% |
| 313  | a7xelte          | Samsung        | Galaxy A7 (2016)          | Exynos 7580        | 2015-12-01   | D      |      638 |      0.01% |
| 314  | j3xnlte          | Samsung        | Galaxy J3 (2016) (SM-J32… | Spreadtrum SC9830I | 2016-05-06   | U      |      637 |      0.01% |
| 314  | athene           | Motorola       | moto g4                   | Snapdragon 617     | 2016-05-01   | D      |      637 |      0.01% |
| 316  | golden           | Samsung        | Galaxy S3 Mini, Galaxy S… | NovaThor U8420     | 2012-11-01   | U      |      636 |      0.01% |
| 317  | deb              | Google         | Nexus 7 2013 (LTE)        | Snapdragon S4 Pro  | 2013-07-26   | D      |      634 |      0.01% |
| 318  | zeroltexx        | Samsung        | Galaxy S6 Edge            | Exynos 7420        | 2015-04-01   | D      |      632 |      0.01% |
| 319  | i9082            | Samsung        | Galaxy Grand Duos i9082,… | Broadcom BCM28155  | 2013-01-01   | U      |      623 |      0.01% |
| 320  | g0215d           | GREE           | G0215D                    | Snapdragon 820     | 2018-08-01   | U      |      622 |      0.01% |
| 321  | rolex            | Xiaomi         | Redmi 4A                  | Snapdragon 425     | 2016-11-01   | U      |      618 |      0.01% |
| 322  | gts28wifi        | Samsung        | Galaxy Tab S2 (8.0”, Wi-… | Exynos 5 Octa 5433 | 2015-09-01   | U      |      609 |      0.01% |
| 323  | starfire         | Lenovo         | ThinkSmart View (CD-1878… | Qualcomm APQ8053   | 2020-08-01   | U      |      601 |      0.01% |
| 324  | cancro           | Xiaomi         | Mi 3, Mi 4                | Snapdragon 800     | 2013-10-01   | D      |      599 |      0.01% |
| 325  | cupid            | Xiaomi         | Xiaomi 12                 | Snapdragon 8 Gen1  | 2021-12-31   | O      |      591 |      0.01% |
| 326  | odroidn2         | HardKernel     | ODROID-N2                 | Amlogic S922X      | 2019-02-01   | U      |      586 |      0.01% |
| 327  | onyx             | OnePlus        | OnePlus X                 | Snapdragon 801     | 2015-11-01   | D      |      584 |      0.01% |
| 328  | cheetah          | Google         | Pixel 7 Pro               | Tensor GS201       | 2022-10-13   | O      |      582 |      0.01% |
| 328  | akari            | Sony           | Xperia XZ2                | Snapdragon 845     | 2018-04-01   | O      |      582 |      0.01% |
| 330  | lt013g           | Samsung        | Galaxy Tab III 8.0 3G, G… | Exynos 4212 Dual   | 2013-07-01   | U      |      580 |      0.01% |
| 330  | billie           | OnePlus        | OnePlus Nord N10          | Snapdragon 690 5G  | 2020-10-26   | O      |      580 |      0.01% |
| 332  | akita            | Google         | Pixel 8a                  | Tensor G3          | 2023-10-04   | O      |      579 |      0.01% |
| 333  | dre              | OnePlus        | OnePlus Nord N200         | Snapdragon 480     | 2021-06-21   | O      |      576 |      0.01% |
| 334  | d2x              | Samsung        | Galaxy Note10+ 5G         | Exynos 9825        | 2019-08-23   | O      |      575 |      0.01% |
| 335  | latte            | Xiaomi         | Mi Pad 2                  | Atom X5-Z8500      | 2015-11-01   | U      |      574 |      0.01% |
| 336  | x86_64_tv_go     |                |                           | x86_64             |              | U      |      561 |      0.01% |
| 337  | j2lte            | Samsung        | Galaxy J2 (J200M/F/G/GU/… | Exynos 3475 Quad   | 2015-09-01   | U      |      559 |      0.01% |
| 338  | x103f            | Lenovo         | Tab 10, Tab3 10 (TB-X103… | Snapdragon 210 or… | 2016-06-01   | U      |      557 |      0.01% |
| 338  | jasmine          | ZTE            | AT&T Trek 2 HD            | Snapdragon 617     | 2016-08-01   | D      |      557 |      0.01% |
| 340  | salami           | OnePlus        | OnePlus 11 5G             | Snapdragon 8 Gen2  | 2023-01-01   | O      |      555 |      0.01% |
| 340  | raven            | Google         | Pixel 6 Pro               | Tensor GS101       | 2021-10-19   | O      |      555 |      0.01% |
| 342  | perseus          | Xiaomi         | Mi MIX 3                  | Snapdragon 845     | 2018-11-01   | O      |      541 |      0.01% |
| 343  | i9100            | Samsung        | Galaxy S II               | Exynos 4210        | 2011-02-11   | D      |      540 |      0.01% |
| 344  | angler           | Google         | Nexus 6P                  | Snapdragon 810     | 2015-09-29   | D      |      537 |      0.01% |
| 345  | ugglite          | Xiaomi         | Redmi Y1, Redmi Note 5A,… | Snapdragon 435     | 2017-08-21   | U      |      532 |      0.01% |
| 345  | angelica         | Xiaomi         | Redmi 9C                  | Helio G35 (12 nm)  | 2020-08-12   | U      |      532 |      0.01% |
| 347  | shiba            | Google         | Pixel 8                   | Tensor G3          | 2023-10-04   | O      |      529 |      0.01% |
| 348  | bach             | Huawei         | MediaPad M3 Lite 8, Medi… | Snapdragon 435     | 2017-06-01   | U      |      528 |      0.01% |
| 349  | twolip           | Xiaomi         | Redmi Note 6 Pro          | Snapdragon 636     | 2018-10-01   | D      |      523 |      0.01% |
| 350  | j7velte          | Samsung        | Galaxy J7 NXT (J701F)     | Exynos 7870 Octa   | 2017-07-01   | U      |      522 |      0.01% |
| 351  | haydn            | Xiaomi         | Mi 11i, Redmi K40 Pro, R… | Snapdragon 888     | 2021-01-01   | O      |      517 |      0.01% |
| 352  | maple_dsds       | Sony           | Xperia XZ Premium Dual S… | Snapdragon 835     | 2017-06-18   | U      |      513 |      0.01% |
| 352  | a3y17lte         | Samsung        | Galaxy A3 (2017) (SM-A32… | Exynos 7870 Octa   | 2017-01-01   | U      |      513 |      0.01% |
| 354  | millet3g         | Samsung        | Galaxy Tab 4 8.0 3G       | Snapdragon 400     | 2014-06-01   | U      |      502 |      0.01% |
| 355  | s3ve3gjv         | Samsung        | Galaxy S III Neo (Samsun… | Snapdragon 400     | 2014-04-11   | D      |      501 |      0.01% |
| 356  | hulkbuster       |                |                           |                    |              | U      |      496 |      0.01% |
| 356  | gts28ltexx       | Samsung        | Galaxy Tab S2 9.7 G3/LTE… | Exynos 5433        | 2015-09-01   | U      |      496 |      0.01% |
| 358  | t0lte            | Samsung        | Galaxy Note 2 (LTE)       | Exynos 4412        | 2012-09-01   | D      |      491 |      0.01% |
| 359  | a3lte            | Samsung        | Galaxy A3 (2015)          | Snapdragon 410     | 2014-12-01   | U      |      485 |      0.01% |
| 360  | berlin           | Motorola       | edge 20                   | Snapdragon 778G 5G | 2021-07-29   | O      |      484 |      0.01% |
| 360  | barbet           | Google         | Pixel 5a                  | Snapdragon 765G    | 2021-08-01   | O      |      484 |      0.01% |
| 362  | kuntao           | Lenovo         | P2                        | Snapdragon 625     | 2016-11-01   | D      |      481 |      0.01% |
| 363  | jfvelte          | Samsung        | Galaxy S4 Value Edition … | Snapdragon 600     | 2014-04-01   | D      |      480 |      0.01% |
| 363  | gts210velte      | Samsung        | Galaxy Tab S2 9.7 LTE (S… | Snapdragon 652     | 2015-09-01   | U      |      480 |      0.01% |
| 365  | wseries          |                |                           |                    |              | U      |      479 |      0.01% |
| 365  | serrano3gxx      | Samsung        | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |      479 |      0.01% |
| 367  | pdx206           | Sony           | Xperia 5 II               | Snapdragon 865     | 2020-09-01   | O      |      476 |      0.01% |
| 368  | cmi              | Xiaomi         | Mi 10 Pro                 | Snapdragon 865     | 2020-02-01   | O      |      475 |      0.01% |
| 368  | cereus           | Xiaomi         | Redmi 6                   | Helio P22 (12 nm)  | 2018-06-01   | U      |      475 |      0.01% |
| 370  | grouper          | ASUS           | Nexus 7 2012              | Tegra 3            | 2012-07-01   | U      |      472 |      0.01% |
| 371  | ido              | Xiaomi         | Redmi 3, Redmi 3 Prime    | Snapdragon 616     | 2016-01-01   | D      |      468 |      0.01% |
| 372  | ks01ltexx        | Samsung        | Galaxy S4 LTE-A (GT-I950… | Snapdragon 800     | 2013-10-01   | U      |      467 |      0.01% |
| 373  | kyleproxx        | Samsung        | Galaxy S Duos 2           | Broadcom BCM 2814… | 2013-12-01   | U      |      466 |      0.01% |
| 374  | serranodsdd      | Samsung        | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |      462 |      0.01% |
| 374  | fleur            | Xiaomi         | Redmi Note 11S, POCO M4 … | Helio G96 (12 nm)  | 2022-02-09   | U      |      462 |      0.01% |
| 376  | pdx215           | Sony           | Xperia 1 III              | Snapdragon 888     | 2021-04-01   | O      |      461 |      0.01% |
| 377  | flashlmdd        | LG             | V50 ThinQ                 | Snapdragon 855     | 2019-02-01   | O      |      455 |      0.01% |
| 378  | zerolte          | Samsung        | Galaxy S6 Edge (SM-G925F) | Exynos 7420 Octa   | 2015-04-10   | U      |      452 |      0.01% |
| 378  | lt033g           | Samsung        | Galaxy Note 10.1 2014 Ed… | Exynos 5420        | 2013-10-10   | U      |      452 |      0.01% |
| 380  | topaz            | Xiaomi         | Redmi Note 12 4G, Redmi … | Snapdragon 685     | 2023-03-01   | U      |      450 |      0.01% |
| 380  | s3ve3gds         | Samsung        | Galaxy S III Neo (Dual S… | Snapdragon 400     | 2014-04-11   | D      |      450 |      0.01% |
| 380  | mondrian         | Xiaomi         | POCO F5 Pro, Redmi K60    | Snapdragon 8+ Gen1 | 2023-05-09   | O      |      450 |      0.01% |
| 383  | gts7lwifi        | Samsung        | Galaxy Tab S7 (Wi-Fi)     | Snapdragon 865+    | 2020-08-21   | O      |      448 |      0.01% |
| 384  | foster           | NVIDIA         | Shield TV (2015 / 2015 P… | Tegra X1 (T210)    | 2015-05-28   | O      |      447 |      0.01% |
| 385  | equuleus         | Xiaomi         | Mi 8 Pro                  | Snapdragon 845     | 2018-09-01   | O      |      445 |      0.01% |
| 386  | garnet           | Xiaomi         | Redmi Note13 Pro 5G, Poc… | Snapdragon 7s Gen… | 2023-09-26   | U      |      443 |      0.01% |
| 387  | a505f            | Samsung        | Galaxy A50                | Exynos 9610        | 2019-03-18   | U      |      441 |      0.01% |
| 388  | j7y17lte         | Samsung        | Galaxy J7 Pro             | Exynos 7870 Octa   | 2017-07-01   | U      |      440 |      0.01% |
| 388  | aura             | Razer          | Phone 2                   | Snapdragon 845     | 2018-10-01   | O      |      440 |      0.01% |
| 390  | waffle           | OnePlus        | OnePlus 12                | Snapdragon 8 Gen3  | 2023-12-01   | O      |      439 |      0.01% |
| 391  | husky            | Google         | Pixel 8 Pro               | Tensor G3          | 2023-10-04   | O      |      437 |      0.01% |
| 392  | d1x              | Samsung        | Galaxy Note10 5G          | Exynos 9825        | 2019-08-23   | O      |      434 |      0.01% |
| 393  | akatsuki         | Sony           | Xperia XZ3                | Snapdragon 845     | 2018-10-01   | O      |      433 |      0.01% |
| 394  | ingres           | Xiaomi         | Poco F4 GT, Redmi K50 Ga… | Snapdragon 8 Gen 1 | 2022-04-28   | U      |      432 |      0.01% |
| 395  | nio              | Motorola       | edge s, moto g100         | Snapdragon 870     | 2021-02-01   | O      |      431 |      0.01% |
| 396  | raphael          | Xiaomi         | Redmi K20 Pro, Mi 9T Pro  | Snapdragon 855     | 2019-08-20   | U      |      430 |     0.010% |
| 397  | mh2lm            | LG             | G8X ThinQ (G850EM/EMW), … | Snapdragon 855     | 2019-06-01   | O      |      429 |     0.010% |
| 398  | sheldon          | Amazon         | Fire TV Stick Lite, Fire… | MediaTek MT8695D   | 2020-09-30   | U      |      428 |     0.010% |
| 399  | cannon           | Xiaomi         | Redmi Note 9 5G, Redmi N… | Dimensity 800U     | 2020-12-01   | U      |      427 |     0.010% |
| 400  | kugo             | Sony           | Xperia X Compact          | Snapdragon 650     | 2016-09-08   | D      |      425 |     0.010% |
| 401  | kirin            | Sony           | Xperia 10                 | Snapdragon 630     | 2019-02-01   | O      |      423 |     0.010% |
| 402  | gta2xlwifi       | Samsung        | Galaxy Tab A 10.5 (2018)… | Snapdragon 450     | 2018-08-01   | U      |      420 |     0.010% |
| 403  | d1               | Samsung        | Galaxy Note10             | Exynos 9825        | 2019-08-23   | O      |      419 |     0.010% |
| 404  | tucana           | Xiaomi         | Mi Note 10, Mi Note 10 P… | Snapdragon 730G    | 2019-11-11   | O      |      418 |     0.010% |
| 404  | TB8704           | Lenovo         | Tab 4 8 Plus (Wi-Fi)      | Snapdragon 625     | 2017-07-01   | U      |      418 |     0.010% |
| 406  | gtanotexllte     | Samsung        | Galaxy Tab A 10.1 (2016)… | Exynos 7870 Octa   | 2016-05-01   | U      |      417 |     0.010% |
| 407  | pdx203           | Sony           | Xperia 1 II               | Snapdragon 865     | 2020-05-01   | O      |      416 |     0.010% |
| 408  | xpeng            | Motorola       | moto g200 5G, Edge S30    | Snapdragon 888+    | 2021-11-01   | O      |      414 |     0.010% |
| 409  | hawao            | Motorola       | moto g42                  | Snapdragon 680 4G  | 2022-06-01   | O      |      411 |     0.010% |
| 410  | m7               | HTC            | One (GSM)                 | Snapdragon 600     | 2013-03-01   | D      |      409 |     0.010% |
| 411  | j5nlte           | Samsung        | Galaxy J5 (2015) (SM-J50… | Snapdragon 410     | 2015-07-28   | U      |      407 |     0.009% |
| 412  | oxygen           | Xiaomi         | Mi Max 2                  | Snapdragon 625     | 2017-06-01   | U      |      406 |     0.009% |
| 412  | R9s              | OPPO           | R9s, R9sk                 | Snapdragon 625     | 2016-10-01   | U      |      406 |     0.009% |
| 414  | a72q             | Samsung        | Galaxy A72                | Snapdragon 720G    | 2021-03-26   | O      |      405 |     0.009% |
| 415  | titan            | Motorola       | moto g (2014)             | Snapdragon 400     | 2014-06-01   | D      |      404 |     0.009% |
| 415  | selene           | Xiaomi         | Redmi 10                  | Helio G88          | 2021-08-20   | U      |      404 |     0.009% |
| 417  | Mi439_4_19       | Xiaomi         | Redmi 8A                  | Snapdragon 439     | 2019-10-01   | U      |      403 |     0.009% |
| 418  | stone            | Xiaomi         | Redmi Note 12, Redmi Not… | Snapdragon 4 Gen 1 | 2023-01-11   | U      |      395 |     0.009% |
| 419  | fuxi             | Xiaomi         | Xiaomi 13                 | Snapdragon 8 Gen2  | 2022-12-11   | O      |      394 |     0.009% |
| 420  | camellia         | Xiaomi         | Redmi Note 10T, Redmi No… | Dimensity 700      | 2021-07-26   | U      |      393 |     0.009% |
| 421  | capricorn        | Xiaomi         | Mi 5s                     | Snapdragon 821     | 2016-10-01   | D      |      392 |     0.009% |
| 422  | checkers         | Amazon         | Echo Show 5               | MediaTek MT8163    | 2019-06-01   | U      |      387 |     0.009% |
| 423  | j53gxx           | Samsung        | Galaxy J5 (2015)          | Snapdragon 410     | 2015-07-28   | U      |      385 |     0.009% |
| 424  | grandprimeve3g   | Samsung        | Galaxy Grand Prime        | Snapdragon 410     | 2014-10-01   | U      |      383 |     0.009% |
| 425  | Pong             | Nothing        | Phone (2)                 | Snapdragon 8+ Gen1 | 2023-07-11   | O      |      381 |     0.009% |
| 426  | waydroid_arm64_… | virtual        | Waydroid ARM64            | ARM64              |              | U      |      379 |     0.009% |
| 426  | riva             | Xiaomi         | Redmi 5A                  | Snapdragon 425     | 2017-12-01   | U      |      379 |     0.009% |
| 428  | x1q              | Samsung        | Galaxy S20                | Exynos 990         | 2020-03-06   | U      |      378 |     0.009% |
| 429  | trelteskt        | Samsung        | Galaxy Note 4 (N910S/L/K) | Snapdragon 805     | 2014-10-01   | U      |      377 |     0.009% |
| 429  | lemonades        | OnePlus        | OnePlus 9R                | Snapdragon 888     | 2021-03-01   | O      |      377 |     0.009% |
| 431  | pollux_windy     | Sony           | Xperia Tablet Z Wi-Fi     | Snapdragon S4 Pro  | 2013-02-01   | D      |      376 |     0.009% |
| 432  | nairo            | Motorola       | moto g 5G plus, moto one… | Snapdragon 662     | 2021-01-01   | O      |      373 |     0.009% |
| 433  | judyln           | LG             | G7 ThinQ (G710AWM/EM/EMW… | Snapdragon 845     | 2018-05-02   | O      |      372 |     0.009% |
| 434  | sumire           | Sony           | Xperia Z5                 | Snapdragon 810     | 2015-09-01   | D      |      371 |     0.009% |
| 435  | v1a3g            | Samsung        | Galaxy Note Pro 12.2      | Exynos 5420 Octa   | 2014-02-01   | U      |      369 |     0.009% |
| 435  | surnia           | Motorola       | moto e LTE (2015)         | Snapdragon 410     | 2015-02-01   | D      |      369 |     0.009% |
| 435  | kminilte         | Samsung        | Galaxy S5 Mini            | Exynos 3470 Quad   | 2014-07-01   | U      |      369 |     0.009% |
| 438  | zeus             | Xiaomi         | Xiaomi 12 Pro             | Snapdragon 8 Gen1  | 2021-12-31   | O      |      366 |     0.009% |
| 439  | zenlte           | Samsung        | Galaxy S6 Edge+           | Exynos 7420 Octa   | 2015-08-01   | U      |      363 |     0.008% |
| 439  | TB8504           | Lenovo         | Tab4 8, Tab 4 8           | Snapdragon 425     | 2017-09-15   | U      |      363 |     0.008% |
| 441  | rtwo             | Motorola       | edge 40 pro, moto X40 ed… | Snapdragon 8 Gen2  | 2023-04-01   | O      |      362 |     0.008% |
| 442  | markw            | Xiaomi         | Redmi 4 Prime             | Snapdragon 625     | 2016-11-01   | U      |      361 |     0.008% |
| 443  | veux             | Xiaomi         | POCO X4 Pro 5G            | Snapdragon 695 5G  | 2022-03-23   | U      |      359 |     0.008% |
| 443  | cebu             | Motorola       | moto g9 power, K12 Pro    | Snapdragon 662     | 2020-11-01   | O      |      359 |     0.008% |
| 445  | wt88047          | Wingtech       | Redmi 2                   | Snapdragon 410     | 2015-01-01   | D      |      358 |     0.008% |
| 446  | duchamp          | Xiaomi         | Redmi K70E, Poco X6 Pro … | Dimensity 8300 Ul… | 2023-11-29   | U      |      357 |     0.008% |
| 446  | dodge            | OnePlus        | 13                        | Snapdragon 8 Elite | 2024-11-01   | O      |      357 |     0.008% |
| 448  | mondrianlte      | Samsung        | Galaxy Tab Pro 8.4 LTE (… | Snapdragon 800     | 2014-03-01   | U      |      356 |     0.008% |
| 449  | gt510lte         | Samsung        | Galaxy Tab A 9.7 (SM-T55… | Snapdragon 410     | 2015-05-01   | U      |      352 |     0.008% |
| 450  | discovery        | Sony           | Xperia XA2 Ultra          | Snapdragon 630     | 2018-02-01   | O      |      351 |     0.008% |
| 451  | s3ve3gxx         | Samsung        | Galaxy S III Neo (Sony C… | Snapdragon 400     | 2014-04-11   | D      |      348 |     0.008% |
| 452  | tangorpro        | Google         | Pixel Tablet              | Tensor GS201       | 2023-06-10   | O      |      347 |     0.008% |
| 453  | zl1              | LeEco          | Le Pro3, Le Pro3 Elite    | Snapdragon 821     | 2016-10-01   | D      |      346 |     0.008% |
| 453  | DRG              | Nokia          | Nokia 6.1 Plus            | Snapdragon 636     | 2018-08-30   | D      |      346 |     0.008% |
| 455  | gt5note10wifi    | Samsung        | Galaxy Tab A 9.7 Wi-Fi (… | Snapdragon 410     | 2015-05-01   | U      |      344 |     0.008% |
| 456  | pdx214           | Sony           | Xperia 5 III              | Snapdragon 888     | 2021-04-01   | O      |      343 |     0.008% |
| 456  | borneo           | Motorola       | moto g power 2021         | Snapdragon 662     | 2021-01-01   | O      |      343 |     0.008% |
| 458  | timelm           | LG             | V60 ThinQ 5G              | Snapdragon 865 5G  | 2020-03-20   | U      |      342 |     0.008% |
| 459  | castor_windy     | Sony           | Xperia Tablet Z2 Wi-Fi    | Snapdragon 801     | 2014-03-26   | D      |      341 |     0.008% |
| 460  | z2_plus          | ZUK            | Z2 Plus                   | Snapdragon 820     | 2016-06-01   | D      |      339 |     0.008% |
| 461  | guam             | Motorola       | moto e7 plus, K12         | Snapdragon 460     | 2020-09-16   | O      |      335 |     0.008% |
| 462  | RM6785           | Realme         | 6, 6i, 6s, Narzo, 7, Nar… | Mediatek MT6785    | 2020-03-11   | U      |      334 |     0.008% |
| 463  | z3tcw            | Sony           | Xperia Z3 Tablet Compact… | Snapdragon 801     | 2014-11-01   | U      |      332 |     0.008% |
| 464  | komodo           | Google         | Pixel 9 Pro XL            | Tensor G4          | 2024-08-22   | O      |      324 |     0.008% |
| 464  | hltetmo          | Samsung        | Galaxy Note 3 LTE (N900T… | Snapdragon 800     | 2013-09-01   | D      |      324 |     0.008% |
| 466  | Z01R             | ASUS           | Zenfone 5Z (ZS620KL)      | Snapdragon 845     | 2018-06-01   | O      |      321 |     0.007% |
| 467  | hanoip           | Motorola       | Moto G60, Moto G40 Fusion | Snapdragon 732G    | 2021-04-27   | U      |      318 |     0.007% |
| 467  | diting           | Xiaomi         | Xiaomi 12T Pro, Redmi K5… | Snapdragon 8+ Gen1 | 2022-10-06   | O      |      318 |     0.007% |
| 467  | bardockpro       | BQ             | Aquaris X Pro             | Snapdragon 626     | 2017-06-01   | D      |      318 |     0.007% |
| 470  | karin            | Sony           | Xperia Z4 Tablet LTE      | Snapdragon 810     | 2015-10-01   | D      |      315 |     0.007% |
| 470  | TBX304           | Lenovo         | Tab4 8, Tab4 10 WIFI      | Qualcomm APQ8017   | 2017-07-01   | U      |      315 |     0.007% |
| 472  | dragon           | Google         | Pixel C                   | Tegra X1 (T210)    | 2015-12-08   | D      |      312 |     0.007% |
| 473  | hltedcm          | Samsung        | Galaxy Note 3 (Docomo SC… | Snapdragon 800     | 2013-09-01   | U      |      311 |     0.007% |
| 474  | phoenix          | Xiaomi         | Redmi K30                 | Snapdragon 730G    | 2019-12-01   | U      |      308 |     0.007% |
| 475  | pdx234           | Sony           | Xperia 1 V                | Snapdragon 8 Gen2  | 2023-05-01   | O      |      307 |     0.007% |
| 476  | miami            | Motorola       | edge 30 neo               | Snapdragon 695     | 2022-10-07   | O      |      306 |     0.007% |
| 476  | beckham          | Motorola       | moto z3 play              | Snapdragon 636     | 2018-06-01   | O      |      306 |     0.007% |
| 478  | suzuran          | Sony           | Xperia Z5 Compact         | Snapdragon 810     | 2015-10-01   | D      |      302 |     0.007% |
| 478  | maple            | Sony           | Xperia XZ Premium         | Snapdragon 835     | 2017-06-18   | U      |      302 |     0.007% |
| 480  | suzu             | Sony           | Xperia X                  | Snapdragon 650     | 2016-05-01   | D      |      301 |     0.007% |
| 480  | a5lte            | Samsung        | Galaxy A5 (A500F)         | Snapdragon 410     | 2014-12-01   | U      |      301 |     0.007% |
| 482  | d802             | LG             | G2 (International)        | Snapdragon 800     | 2013-09-12   | D      |      298 |     0.007% |
| 483  | v2awifi          | Samsung        | Galaxy Tab Pro 12.2 WiFi  | Exynos 5420 Octa   | 2014-03-01   | U      |      297 |     0.007% |
| 484  | zenfone3         | ASUS           | Zenfone 3                 | Snapdragon 625     | 2016-05-30   | D      |      292 |     0.007% |
| 485  | ocn              | HTC            | U11                       | Snapdragon 835     | 2017-06-10   | U      |      291 |     0.007% |
| 486  | santos10lte      | Samsung        | Galaxy Tab 3 10.1 LTE (G… | Atom Z2560         | 2013-07-07   | U      |      290 |     0.007% |
| 486  | m52xq            | Samsung        | Galaxy M52 5G             | Snapdragon 778G 5G | 2021-10-03   | O      |      290 |     0.007% |
| 488  | aston            | OnePlus        | OnePlus 12R               | Snapdragon 8 Gen2  | 2024-01-01   | O      |      289 |     0.007% |
| 489  | shieldtablet     | NVIDIA         | Shield Tablet             | Tegra K1 (T124)    | 2014-07-29   | D      |      288 |     0.007% |
| 490  | j6lte            | Samsung        | Galaxy J6                 | Exynos 7870        | 2018-05-01   | U      |      287 |     0.007% |
| 490  | gts28velte       | Samsung        | Galaxy Tab S2 8.0 (T719)  | Snapdragon 652     | 2016-07-01   | U      |      287 |     0.007% |
| 492  | spaced           |                |                           |                    |              | U      |      285 |     0.007% |
| 492  | manta            | Google         | Nexus 10                  | Exynos 5250        | 2012-11-13   | D      |      285 |     0.007% |
| 494  | martini          | OnePlus        | OnePlus 9RT               | Snapdragon 888     | 2021-10-01   | O      |      283 |     0.007% |
| 495  | castor           | Sony           | Xperia Tablet Z2 LTE      | Snapdragon 801     | 2014-03-26   | D      |      281 |     0.007% |
| 496  | klteduos         | Samsung        | Galaxy S5 LTE Duos (G900… | Snapdragon 801     | 2014-06-01   | D      |      280 |     0.007% |
| 497  | a73xq            | Samsung        | Galaxy A73 5G             | Snapdragon 778G 5G | 2022-04-22   | O      |      276 |     0.006% |
| 498  | kltekor          | Samsung        | Galaxy S5 LTE (G900K/L/S) | Snapdragon 801     | 2014-04-01   | D      |      275 |     0.006% |
| 498  | YTX703L          | Lenovo         | Yoga Tab 3 Plus LTE       | Snapdragon 652     | 2016-12-01   | D      |      275 |     0.006% |
| 500  | sunny            | Xiaomi         | Redmi Note 10             | Snapdragon 678     | 2021-03-16   | U      |      273 |     0.006% |
| 501  | sakura           | Xiaomi         | Redmi 6 Pro, Mi A2 Lite   | Snapdragon 625     | 2018-07-01   | U      |      272 |     0.006% |
| 502  | serranovelte     | Samsung        | Galaxy S4 Mini (GT-I9195… | Snapdragon 410     | 2015-06-01   | U      |      271 |     0.006% |
| 502  | judypn           | LG             | V40 ThinQ                 | Snapdragon 845     | 2018-10-03   | O      |      271 |     0.006% |
| 504  | hltechn          | Samsung        | Galaxy Note 3 LTE (N9008… | Snapdragon 800     | 2013-09-01   | D      |      267 |     0.006% |
| 505  | oscaro           | OnePlus        | OnePlus Nord CE 2 Lite 5G | Snapdragon 695     | 2022-04-30   | O      |      265 |     0.006% |
| 506  | lava             | Xiaomi         | Redmi 9, Poco M2          | Helio G80          | 2020-06-10   | U      |      264 |     0.006% |
| 506  | j5y17lte         | Samsung        | Galaxy J5 (2017) (SM-J53… | Exynos 7870 Octa   | 2017-06-01   | U      |      264 |     0.006% |
| 508  | n8000_deodexed   | Samsung        | Galaxy Note 10.1 3G (GT-… | Exynos 4412 Quad   | 2012-08-01   | U      |      261 |     0.006% |
| 509  | picassolte       | Samsung        | Galaxy Tab Pro 10.1 LTE … | Snapdragon 800     | 2014-03-01   | U      |      259 |     0.006% |
| 510  | m31              | Samsung        | Galaxy M31                | Exynos 9611        | 2020-03-05   | U      |      257 |     0.006% |
| 511  | pstar            | Motorola       | edge 20 pro               | Snapdragon 870     | 2021-08-01   | O      |      254 |     0.006% |
| 511  | milletlte        | Samsung        | Galaxy Tab4 8.0 LTE (SM-… | Snapdragon 400     | 2014-06-01   | U      |      254 |     0.006% |
| 511  | m23xq            | Samsung        | Galaxy M23, Galaxy F23 5G | Snapdragon 750G 5G | 2022-04-08   | U      |      254 |     0.006% |
| 511  | dm1q             | Samsung        | Galaxy S23                | Snapdragon 8 Gen 2 | 2023-02-17   | U      |      254 |     0.006% |
| 515  | caiman           | Google         | Pixel 9 Pro               | Tensor G4          | 2024-09-09   | O      |      253 |     0.006% |
| 516  | z3               | Sony           | Xperia Z3                 | Snapdragon 801     | 2014-09-04   | D      |      252 |     0.006% |
| 516  | nitrogen         | Xiaomi         | Mi MAX 3                  | Snapdragon 636     | 2018-07-01   | U      |      252 |     0.006% |
| 518  | rhodep           | Motorola       | moto g82 5G               | Snapdragon 695     | 2022-06-07   | O      |      249 |     0.006% |
| 518  | a40              | Samsung        | Galaxy A40                | Exynos 7904        | 2019-04-01   | U      |      249 |     0.006% |
| 520  | kiwi             | Huawei         | Honor 5X                  | Snapdragon 616     | 2015-11-01   | D      |      248 |     0.006% |
| 521  | bardock          | BQ             | Aquaris X                 | Snapdragon 626     | 2017-06-01   | D      |      247 |     0.006% |
| 521  | alphaplus        | LG             | G8 ThinQ, G8 ThinQ (Kore… | Snapdragon 855     | 2019-02-01   | O      |      247 |     0.006% |
| 523  | pollux           | Sony           | Xperia Tablet Z LTE       | Snapdragon S4 Pro  | 2013-02-01   | D      |      246 |     0.006% |
| 524  | a505fn           | Samsung        | Galaxy A50 (SM-A505FN)    | Exynos 9610        | 2019-03-18   | U      |      245 |     0.006% |
| 525  | gvwifi           | Samsung        | Galaxy View WiFi (SM-T67… | Exynos 7580 Octa   | 2015-11-01   | U      |      241 |     0.006% |
| 526  | sky              | Xiaomi         | Redmi 12, POCO M6 Pro 5G  | Snapdragon 4 Gen 2 | 2023-08-04   | U      |      240 |     0.006% |
| 526  | r8s              | Samsung        | Galaxy S20 FE (SM-G780F)  | Exynos 990         | 2020-10-02   | U      |      240 |     0.006% |
| 528  | racer            | Motorola       | edge                      | Snapdragon 765G    | 2020-05-01   | O      |      239 |     0.006% |
| 529  | kltedv           | Samsung        | Galaxy S5 LTE (G900I/P)   | Snapdragon 801     | 2014-04-01   | D      |      235 |     0.005% |
| 530  | ovaltine         | OnePlus        | 10T 5G                    | Snapdragon 8+ Gen… | 2022-08-06   | U      |      233 |     0.005% |
| 531  | land             | Xiaomi         | Redmi 3S, Redmi 3X        | Snapdragon 430     | 2016-06-01   | D      |      232 |     0.005% |
| 532  | d855             | LG             | G3 (International)        | Snapdragon 801     | 2014-06-01   | D      |      229 |     0.005% |
| 533  | pine             | Xiaomi         | Redmi 7A                  | Snapdragon 439     | 2019-07-04   | U      |      222 |     0.005% |
| 533  | apollo           | Xiaomi         | Mi 10T 5G, Mi 10T Pro, R… | Snapdragon 865 5G  | 2020-10-13   | U      |      222 |     0.005% |
| 535  | FP2              | Fairphone      | Fairphone 2               | Snapdragon 801     | 2015-12-01   | D      |      220 |     0.005% |
| 536  | togari           | Sony           | Xperia Z Ultra            | Snapdragon 800     | 2013-07-01   | U      |      219 |     0.005% |
| 536  | poplar           | Sony           | Xperia XZ1 (G8341)        | Snapdragon 835     | 2017-09-19   | U      |      219 |     0.005% |
| 538  | grandprimevelte  | Samsung        | Galaxy Grand Prime VE LTE | Marvell PXA1908    | 2015-07-29   | U      |      216 |     0.005% |
| 538  | RMX2185          | Realme         | C11                       | Helio G35          | 2020-07-07   | U      |      216 |     0.005% |
| 540  | virtio_arm64only | virtual        |                           | ARM64              |              | U      |      215 |     0.005% |
| 541  | sirius           | Sony           | Xperia Z2                 | Snapdragon 801     | 2014-04-01   | D      |      214 |     0.005% |
| 542  | sea              | Xiaomi         | Redmi Note 12S            | Helio G96 (12 nm)  | 2023-04-26   | U      |      213 |     0.005% |
| 542  | oce              | HTC            | U Ultra, Ocean Note       | Snapdragon 821     | 2017-02-21   | U      |      213 |     0.005% |
| 544  | A102             | Micromax       | Canvas Doodle 3 (A102)    | Mediatek MT6572    | 2014-04-01   | U      |      212 |     0.005% |
| 545  | r9s              | OPPO           | R9s                       | Snapdragon 625     | 2016-10-01   | U      |      211 |     0.005% |
| 546  | TB2-X30L         | Lenovo         | TAB 2 A10-30 (TB2-X30L)   | Snapdragon 210     | 2015-10-29   | U      |      210 |     0.005% |
| 547  | venus            | Xiaomi         | Mi 11                     | Snapdragon 888 5G  | 2021-01-01   | U      |      209 |     0.005% |
| 547  | gt5note10lte     | Samsung        | Galaxy Tab A 9.7 LTE (SM… | Snapdragon 410     | 2015-06-01   | U      |      209 |     0.005% |
| 549  | z3tc             | Sony           | Xperia Z3 Tablet Compact  | Snapdragon 801     | 2014-11-01   | U      |      208 |     0.005% |
| 549  | amami            | Sony           | Xperia Z1 compact         | Snapdragon 800     | 2014-01-01   | U      |      208 |     0.005% |
| 551  | pdx235           | Sony           | Xperia 10 V               | Snapdragon 695     | 2023-06-21   | O      |      207 |     0.005% |
| 551  | mako             | Google         | Nexus 4                   | Snapdragon S4 Pro  | 2012-11-13   | D      |      207 |     0.005% |
| 551  | addison          | Motorola       | moto z play               | Snapdragon 625     | 2016-09-01   | D      |      207 |     0.005% |
| 554  | beethoven        | Huawei         | Mediapad M3 8.4           | Kirin 950          | 2016-10-01   | U      |      206 |     0.005% |
| 554  | X00T             | ASUS           | Zenfone Max Pro M1        | Snapdragon 636     | 2018-05-01   | U      |      206 |     0.005% |
| 556  | xun              | Xiaomi         | Redmi Pad SE              | Snapdragon 680 4G  | 2023-09-01   | U      |      204 |     0.005% |
| 557  | pipa             | Xiaomi         | Pad 6                     | Snapdragon 870 5G  | 2023-04-18   | U      |      203 |     0.005% |
| 557  | amar_row_lte     | Lenovo         | Tab M10 HD (2nd Gen)      | Helio P22T         | 2020-11-01   | U      |      203 |     0.005% |
| 559  | sapphire         | Xiaomi         | Redmi Note 13 4G, Redmi … | Snapdragon 685     | 2024-01-15   | U      |      202 |     0.005% |
| 560  | btvdl09          | Huawei         | Mediapad M3 8.4 (BTV-DL0… | Kirin 950          | 2016-10-01   | U      |      201 |     0.005% |
| 561  | honami           | Sony           | Xperia Z1 (C6903)         | Snapdragon 800     | 2013-09-01   | U      |      200 |     0.005% |
| 561  | griffin          | Motorola       | moto z                    | Snapdragon 820     | 2016-09-01   | D      |      200 |     0.005% |
| 561  | giza             | Amazon         | Fire HD 8 7/6th gen (KFG… | MediaTek MT8163V/B | 2016-09-21   | U      |      200 |     0.005% |
| 564  | capri            | Motorola       | moto g10, moto g10 power… | Snapdragon 460     | 2021-02-01   | O      |      198 |     0.005% |
| 565  | tanzanite        | Xiaomi         | Redmi Note 14 4G          | Helio G99 Ultra    | 2025-01-15   | U      |      197 |     0.005% |
| 565  | btv              | Huawei         | Mediapad M3 8.4           | Kirin 950          | 2016-10-01   | U      |      197 |     0.005% |
| 567  | tblte            | Samsung        | Galaxy Note Edge (SM-N91… | Snapdragon 805     | 2014-11-01   | U      |      195 |     0.005% |
| 568  | tundra           | Motorola       | edge 30 fusion            | Snapdragon 888+    | 2022-09-01   | O      |      190 |     0.004% |
| 568  | thyme            | Xiaomi         | Mi 10S                    | Snapdragon 870     | 2021-03-01   | O      |      190 |     0.004% |
| 568  | ariel            | Amazon         | Fire HD 6/7               | MediaTek MT8135V   | 2014-10-02   | U      |      190 |     0.004% |
| 571  | pdx225           | Sony           | Xperia 10 IV              | Snapdragon 695     | 2022-06-30   | O      |      189 |     0.004% |
| 571  | a53x             | Samsung        | Galaxy A53 5G             | Exynos 1280 (5 nm) | 2022-03-24   | U      |      189 |     0.004% |
| 573  | z3c              | Sony           | Xperia Z3 Compact         | Snapdragon 801     | 2014-09-04   | D      |      188 |     0.004% |
| 573  | lux              | Motorola       | moto x play               | Snapdragon 615     | 2015-08-01   | D      |      188 |     0.004% |
| 573  | elish            | Xiaomi         | Pad 5 Pro Wi-Fi           | Snapdragon 870 5G  | 2021-08-10   | U      |      188 |     0.004% |
| 576  | js01lte          | Samsung        | Galaxy J (Docomo SC-02F)  | Snapdragon 800     | 2013-12-01   | U      |      187 |     0.004% |
| 576  | degaslte         | Samsung        | Galaxy Tab 4 7.0 LTE, Ga… | Exynos 3470 Quad   | 2014-05-01   | U      |      187 |     0.004% |
| 576  | NB1              | Nokia          | Nokia 8                   | Snapdragon 835     | 2017-08-16   | O      |      187 |     0.004% |
| 579  | socrates         | Xiaomi         | Redmi K60 Pro             | Snapdragon 8 Gen2  | 2022-12-27   | O      |      186 |     0.004% |
| 580  | RMX1821          | Realme         | 3 (RMX1821)               | Helio P60          | 2019-03-01   | U      |      185 |     0.004% |
| 581  | nabu             | Xiaomi         | Pad 5                     | Snapdragon 860     | 2021-08-10   | U      |      184 |     0.004% |
| 581  | cheryl           | Razer          | Phone                     | Snapdragon 835     | 2017-11-01   | O      |      184 |     0.004% |
| 583  | curtana          | Xiaomi         | Redmi Note 9S, Redmi Not… | Snapdragon 720G    | 2020-04-30   | U      |      182 |     0.004% |
| 584  | p3s              |                |                           |                    |              | U      |      181 |     0.004% |
| 584  | giulia           | OnePlus        | 13R, Ace 5                | Snapdragon 8 Gen 3 | 2025-01-14   | U      |      181 |     0.004% |
| 586  | o1s              | Samsung        | Galaxy S21 5G (SM-G991B/… | Exynos 2100        | 2021-01-29   | U      |      180 |     0.004% |
| 586  | monet            | Xiaomi         | Mi 10 Lite 5G             | Snapdragon 765G    | 2020-05-01   | D      |      180 |     0.004% |
| 588  | dm3q             | Samsung        | Galaxy S23 Ultra          | Snapdragon 8 Gen 2 | 2023-02-17   | U      |      179 |     0.004% |
| 589  | tre3calteskt     | Samsung        | Galaxy Note 4 (N916S/L/K) | Exynos 5433        | 2014-10-01   | U      |      178 |     0.004% |
| 589  | X01BD            | ASUS           | Zenfone Max Pro M2        | Snapdragon 660     | 2018-12-01   | D      |      178 |     0.004% |
| 591  | v500             | LG             | G Pad 8.3                 | Snapdragon 600     | 2013-10-14   | D      |      175 |     0.004% |
| 592  | odroidxu3        | HardKernel     | ODROID-XU3                | Exynos 5422        | 2014-08-18   | U      |      174 |     0.004% |
| 593  | rodin            | Xiaomi         | Poco X7 Pro               | Dimensity 8400 Ul… | 2025-01-09   | U      |      173 |     0.004% |
| 593  | meliusltexx      | Samsung        | Galaxy Mega 6.3           | Snapdragon 400     | 2013-06-01   | U      |      173 |     0.004% |
| 593  | j1acevelte       | Samsung        | Galaxy J1 Ace VE, Galaxy… | Spreadtrum SC9830  | 2016-07-11   | U      |      173 |     0.004% |
| 593  | flounder         | Google         | Nexus 9 (Wi-Fi)           | Tegra K1 (T124)    | 2014-11-03   | D      |      173 |     0.004% |
| 593  | avalon           | OnePlus        | Nord 4                    | Snapdragon 7+ Gen… | 2024-07-01   | O      |      173 |     0.004% |
| 598  | z3s              | Samsung        | Galaxy S20 Ultra (5G)     | Exynos 990         | 2020-03-06   | O      |      172 |     0.004% |
| 598  | i9305            | Samsung        | Galaxy S III (LTE / Inte… | Exynos 4412        | 2012-10-01   | D      |      172 |     0.004% |
| 600  | odin             | Sony           | Xperia ZL                 | Snapdragon S4 Pro  | 2013-03-01   | D      |      170 |     0.004% |
| 600  | a54x             | Samsung        | Galaxy A54 5G             | Exynos 1380        | 2023-03-24   | U      |      170 |     0.004% |
| 602  | xaga             | Xiaomi         | POCO X4 GT                | Dimensity 8100     | 2022-06-27   | U      |      169 |     0.004% |
| 602  | kagura           | Sony           | Xperia XZ Dual (F8332)    | Snapdragon 820     | 2016-10-03   | U      |      169 |     0.004% |
| 604  | pme              | HTC            | HTC 10                    | Snapdragon 820     | 2016-05-01   | D      |      168 |     0.004% |
| 604  | chopin           | Xiaomi         | Redmi Note 10 PRO 5G      | Snapdragon 732G    | 2021-03-24   | U      |      168 |     0.004% |
| 606  | quill            | NVIDIA         | Jetson TX2 [Android TV],… | Tegra X2 (T186)    | 2017-03-14   | O      |      167 |     0.004% |
| 607  | q5q              | Samsung        | Galaxy Z Fold 5           | Snapdragon 8 Gen 2 | 2023-08-11   | U      |      166 |     0.004% |
| 607  | TB8703N          | Lenovo         | Tab3 8 plus               | Snapdragon 625     | 2017-03-01   | U      |      166 |     0.004% |
| 609  | odroidc4         | HardKernel     | ODROID-C4 (Android TV)    | Amlogic S905X3     | 2020-12-01   | O      |      165 |     0.004% |
| 610  | victara          | Motorola       | moto x (2014)             | Snapdragon 801     | 2014-09-26   | D      |      164 |     0.004% |
| 610  | poplar_dsds      | Sony           | Xperia XZ1 Dual (F8342)   | Snapdragon 835     | 2017-09-19   | U      |      164 |     0.004% |
| 610  | beyond1          | Samsung        | Galaxy S10                | Exynos 9820        | 2019-03-08   | U      |      164 |     0.004% |
| 613  | crackling        | Wileyfox       | Swift                     | Snapdragon 410     | 2015-10-01   | D      |      163 |     0.004% |
| 614  | sake             | ASUS           | ZenFone 8                 | Snapdragon 888     | 2021-05-01   | O      |      162 |     0.004% |
| 615  | j1xlte           | Samsung        | Galaxy J1 (2016) (SM-J12… | Spreadtrum SC9830  | 2016-01-01   | U      |      161 |     0.004% |
| 616  | gts7l            | Samsung        | Galaxy Tab S7 (LTE)       | Snapdragon 865+    | 2020-08-21   | O      |      160 |     0.004% |
| 616  | gt58ltebmc       | Samsung        | Galaxy Tab A 8.0 (SM-T35… | Snapdragon 410     | 2015-05-01   | U      |      160 |     0.004% |
| 616  | a5ultexx         | Samsung        | Galaxy A5 (A500FU)        | Snapdragon 410     | 2014-12-01   | U      |      160 |     0.004% |
| 619  | vili             | Xiaomi         | 11T Pro                   | Snapdragon 888 5G  | 2021-10-05   | U      |      159 |     0.004% |
| 619  | tapas            | Xiaomi         | Redmi Note 12 4G          | Snapdragon 685     | 2023-03-30   | U      |      159 |     0.004% |
| 621  | hima             | HTC            | One M9                    | Snapdragon 810     | 2015-03-09   | U      |      158 |     0.004% |
| 621  | f62              | Samsung        | Galaxy F62, Galaxy M62    | Exynos 9825        | 2021-02-22   | O      |      158 |     0.004% |
| 621  | erhai            | OnePlus        | OnePlus Pad 2 Pro, OnePl… | Snapdragon 8 Elite | 2025-05-01   | O      |      158 |     0.004% |
| 624  | r5x              |                |                           |                    |              | U      |      157 |     0.004% |
| 625  | nuwa             | Xiaomi         | Xiaomi 13 Pro             | Snapdragon 8 Gen2  | 2022-12-11   | O      |      156 |     0.004% |
| 625  | a05m             |                |                           |                    |              | U      |      156 |     0.004% |
| 627  | mermaid          | Sony           | Xperia 10 Plus            | Snapdragon 636     | 2019-02-01   | O      |      155 |     0.004% |
| 627  | ja3gxx           | Samsung        | Galaxy S4 (I9500)         | Exynos 5410 Octa   | 2013-04-01   | U      |      155 |     0.004% |
| 629  | vivalto3mveml3g  | Samsung        | Galaxy Ace 4 Neo (SM-G31… | Spreadtrum SC8830  | 2014-08-01   | U      |      154 |     0.004% |
| 629  | sweet2           | Xiaomi         | Redmi Note 12 Pro         | Dimensity 1080     | 2022-11-01   | U      |      154 |     0.004% |
| 629  | pro1x            | F(x)tec        | Pro¹ X                    | Snapdragon 662     | 2022-12-01   | O      |      154 |     0.004% |
| 632  | RMX1931          | Realme         | X2 Pro (RMX1931)          | Snapdragon 855+    | 2019-10-01   | U      |      153 |     0.004% |
| 633  | vermeer          | Xiaomi         | POCO F6 Pro               | Snapdragon 8 Gen2  | 2024-05-28   | O      |      152 |     0.004% |
| 633  | m21              | Samsung        | Galaxy M21                | Exynos 9611        | 2020-03-23   | U      |      152 |     0.004% |
| 635  | n7000            | Samsung        | Galaxy Note N7000         | Exynos 4210 Dual   | 2011-10-01   | U      |      151 |     0.004% |
| 635  | karate           | Lenovo         | K6 Power                  | Snapdragon 430     | 2016-11-01   | U      |      151 |     0.004% |
| 635  | j4corelte        | Samsung        | Galaxy J4+                | Snapdragon 425     | 2018-10-01   | U      |      151 |     0.004% |
| 635  | b2q              | Samsung        | Galaxy Z Flip3 5G         | Snapdragon 888 5G  | 2021-08-27   | U      |      151 |     0.004% |
| 635  | a32              | Samsung        | Galaxy A32 4G             | Helio G80 (12 nm)  | 2021-02-25   | U      |      151 |     0.004% |
| 640  | courbet          | Xiaomi         | Mi 11 Lite 4G             | Snapdragon 732G    | 2021-04-16   | U      |      150 |     0.003% |
| 641  | yuga             | Sony           | Xperia Z                  | Snapdragon S4 Pro  | 2013-02-01   | D      |      149 |     0.003% |
| 641  | ham              | ZUK            | Z1                        | Snapdragon 801     | 2015-10-14   | D      |      149 |     0.003% |
| 643  | voyager          | Sony           | Xperia XA2 Plus           | Snapdragon 630     | 2018-07-01   | O      |      148 |     0.003% |
| 643  | ss2              | Sharp          | Aquos S2                  | Snapdragon 630 an… | 2017-08-01   | U      |      148 |     0.003% |
| 643  | b5q              | Samsung        | Galaxy Z Flip 5           | Snapdragon 8 Gen 2 | 2023-08-11   | U      |      148 |     0.003% |
| 646  | goyavewifi       | Samsung        | Galaxy Tab E 7” (SM-T113… | Spreadtrum SC8830  | 2015-03-01   | U      |      144 |     0.003% |
| 647  | kltekdi          | Samsung        | Galaxy S5 LTE (SC-04F/SC… | Snapdragon 801     | 2014-05-01   | D      |      141 |     0.003% |
| 648  | RMX2020          | Realme         | C3                        | Helio G70          | 2020-02-14   | U      |      140 |     0.003% |
| 649  | Z1               |                |                           |                    |              | U      |      139 |     0.003% |
| 650  | pdx237           | Sony           | Xperia 5 V                | Snapdragon 8 Gen2  | 2023-09-01   | O      |      138 |     0.003% |
| 650  | milanf           | Motorola       | moto g stylus 5G (2022)   | Snapdragon 695     | 2022-04-27   | O      |      138 |     0.003% |
| 650  | hannah           | Motorola       | moto e5 plus (XT1924-6/7… | Snapdragon 435     | 2018-05-01   | D      |      138 |     0.003% |
| 650  | B2N              | Nokia          | Nokia 7 plus              | Snapdragon 660     | 2018-04-30   | O      |      138 |     0.003% |
| 654  | satsuki          | Sony           | Xperia Z5 Premium         | Snapdragon 810     | 2015-11-05   | U      |      136 |     0.003% |
| 655  | albus            | Motorola       | moto z2 play              | Snapdragon 626     | 2017-06-01   | D      |      132 |     0.003% |
| 656  | t2s              |                |                           |                    |              | U      |      130 |     0.003% |
| 656  | a21snsxx         | Samsung        | Galaxy A21s               | Exynos 850 (8 nm)  | 2020-06-02   | U      |      130 |     0.003% |
| 658  | s3ve3g           | Samsung        | Galaxy S3 Neo             | Snapdragon 400     | 2014-04-01   | U      |      129 |     0.003% |
| 658  | r7               | OPPO           | R7                        | Snapdragon 615     | 2015-05-01   | U      |      129 |     0.003% |
| 658  | dopinder         | Walmart        | onn. TV Box 4K (2021)     | Amlogic S905Y2     | 2021-06-01   | O      |      129 |     0.003% |
| 661  | peregrine        | Motorola       | moto g 4G                 | Snapdragon 400     | 2014-06-01   | D      |      127 |     0.003% |
| 661  | marmite          | Wileyfox       | Swift 2, Swift 2 Plus, S… | Snapdragon 430     | 2016-11-01   | U      |      127 |     0.003% |
| 661  | dandelion        | Xiaomi         | Redmi 9A                  | Helio G25          | 2020-07-07   | U      |      127 |     0.003% |
| 661  | a3ltexx          | Samsung        | Galaxy A3 (A300F)         | Snapdragon 410     | 2014-12-01   | U      |      127 |     0.003% |
| 665  | q2q              |                |                           |                    |              | U      |      126 |     0.003% |
| 665  | f310p            |                |                           |                    |              | U      |      126 |     0.003% |
| 665  | P350             | Samsung        | Galaxy Tab A 8" with S P… | Snapdragon 410     | 2015-05-01   | U      |      126 |     0.003% |
| 668  | lt02ltespr       | Samsung        | Galaxy Tab 3 7.0 LTE      | Snapdragon 400     | 2016-09-01   | D      |      125 |     0.003% |
| 668  | jactivelte       | Samsung        | Galaxy S4 Active          | Snapdragon 600     | 2013-06-01   | D      |      125 |     0.003% |
| 668  | h850             | LG             | G5 (International)        | Snapdragon 820     | 2016-02-01   | D      |      125 |     0.003% |
| 668  | felix            | Google         | Pixel Fold                | Tensor GS201       | 2023-06-27   | O      |      125 |     0.003% |
| 672  | nx659j           | Nubia          | Red Magic 5G (Global), R… | Snapdragon 865     | 2020-03-01   | O      |      124 |     0.003% |
| 672  | kccat6           | Samsung        | Galaxy S5 Plus            | Snapdragon 805     | 2014-08-21   | D      |      124 |     0.003% |
| 672  | foster_tab       | NVIDIA         | Shield TV (2015 / 2015 P… | Tegra X1 (T210)    | 2015-05-28   | O      |      124 |     0.003% |
| 672  | FP6              | Fairphone      | 6                         | Snapdragon 7s Gen… | 2025-06-25   | U      |      124 |     0.003% |
| 676  | n5120            | Samsung        | Galaxy Note 8.0 (LTE)     | Exynos 4412        | 2013-04-01   | D      |      123 |     0.003% |
| 676  | a34x             | Samsung        | Galaxy A34 5G             | Dimensity 1080     | 2023-03-24   | U      |      123 |     0.003% |
| 678  | b0q              |                |                           |                    |              | U      |      121 |     0.003% |
| 678  | TBX304F          | Lenovo         | Tab4 10 WiFi (TB-X304F)   | Qualcomm APQ8017   | 2017-07-01   | U      |      121 |     0.003% |
| 678  | RMP6768          | Realme         | Pad                       | Helio G80          | 2021-09-16   | U      |      121 |     0.003% |
| 681  | shark            | Xiaomi         | Black Shark               | Snapdragon 845     | 2018-04-01   | O      |      120 |     0.003% |
| 681  | bouquet          | Xiaomi         | Redmi Note 6 Pro          | Snapdragon 636     | 2018-10-01   | U      |      120 |     0.003% |
| 681  | bahamut          | Sony           | Xperia 1, Xperia 5        | Snapdragon 855     | 2019-05-30   | U      |      120 |     0.003% |
| 684  | x86_64_tablet    |                |                           | x86_64             |              | U      |      119 |     0.003% |
| 684  | redwood          | Xiaomi         | Poco X5 Pro               | Snapdragon 778G 5G | 2023-02-07   | U      |      119 |     0.003% |
| 684  | RMX2001L1        | Realme         | 6, 6i (India), 6s, Narzo  | Helio G90T         | 2020-03-11   | U      |      119 |     0.003% |
| 687  | gta2swifi        | Samsung        | Galaxy Tab A WiFi (SM-T3… | Snapdragon 425     | 2017-09-01   | U      |      118 |     0.003% |
| 688  | tb128fu          | Lenovo         | Xiaoxin Pad 2022 (TB128F… | Snapdragon 680     | 2022-05-01   | U      |      116 |     0.003% |
| 688  | heart            | Lenovo         | Z5 Pro GT                 | Snapdragon 855     | 2019-01-29   | O      |      116 |     0.003% |
| 688  | fire             |                |                           |                    |              | U      |      116 |     0.003% |
| 688  | denver           | Motorola       | moto g stylus 5G          | Snapdragon 480     | 2021-06-14   | O      |      116 |     0.003% |
| 692  | viva             | Xiaomi         | Redmi Note 11 Pro 4G      | Helio G96          | 2022-02-18   | U      |      115 |     0.003% |
| 692  | nikel            | Xiaomi         | Redmi Note 4              | Snapdragon 625     | 2017-01-01   | U      |      115 |     0.003% |
| 694  | trhpltexx        | Samsung        | Galaxy Note 4 (N910U)     | Exynos 5 Octa 5433 | 2014-10-01   | U      |      114 |     0.003% |
| 694  | debx             | Google         | Nexus 7 2013 (LTE, Repar… | Snapdragon S4 Pro  | 2013-07-26   | D      |      114 |     0.003% |
| 696  | toco             | Xiaomi         | Mi Note 10 Lite           | Snapdragon 730G    | 2020-05-09   | U      |      113 |     0.003% |
| 696  | RMX1941          | Realme         | C2                        | Helio P22          | 2019-05-01   | U      |      113 |     0.003% |
| 698  | unicorn          | Xiaomi         | Xiaomi 12S Pro            | Snapdragon 8+ Gen1 | 2022-07-04   | O      |      112 |     0.003% |
| 698  | r11s             | OPPO           | R11                       | Snapdragon 660     | 2017-06-01   | U      |      112 |     0.003% |
| 698  | h990             | LG             | V20 (Global)              | Snapdragon 820     | 2016-10-01   | D      |      112 |     0.003% |
| 698  | btvw09           | Huawei         | Mediapad M3 8.4 (BTV-W09… | Kirin 950          | 2016-10-01   | U      |      112 |     0.003% |
| 698  | RMX1851          | Realme         | Realme 3 Pro              | Snapdragon 710     | 2019-04-29   | D      |      112 |     0.003% |
| 703  | trlteduos        | Samsung        | Galaxy Note 4             | Snapdragon 805     | 2014-10-01   | U      |      111 |     0.003% |
| 703  | A10-70L          | Lenovo         | Tab 2 LTE (A10-70L)       | Mediatek MT8732    | 2015-04-01   | U      |      111 |     0.003% |
| 705  | ingot            | Solana         | Saga                      | Snapdragon 8+ Gen1 | 2023-05-01   | O      |      110 |     0.003% |
| 705  | a42xq            | Samsung        | Galaxy A42 5G             | Snapdragon 750 5G  | 2020-11-11   | U      |      110 |     0.003% |
| 707  | g710n            | LG             | G7 ThinQ (G710N)          | Snapdragon 845     | 2018-05-02   | O      |      108 |     0.003% |
| 708  | karin_windy      | Sony           | Xperia Z4 Tablet WiFi     | Snapdragon 810     | 2015-10-01   | D      |      107 |     0.002% |
| 708  | fortunave3g      | Samsung        | Galaxy Grand Prime (SM-G… | Snapdragon 410     | 2014-10-01   | U      |      107 |     0.002% |
| 708  | bronco           | Motorola       | ThinkPhone by motorola    | Snapdragon 8+ Gen1 | 2023-01-01   | O      |      107 |     0.002% |
| 711  | yunluo           | Xiaomi         | Redmi Pad                 | Helio G99          | 2022-10-05   | U      |      106 |     0.002% |
| 711  | realme_trinket   | Realme         | 5, 5i, 5s, 5 NFC, 5 Viet… | Snapdragon 665     | 2019-08-01   | U      |      106 |     0.002% |
| 711  | gracelte         | Samsung        | Note 7 (SM-N930F)         | Exynos 8890 Octa   | 2016-09-01   | U      |      106 |     0.002% |
| 714  | ares             | Xiaomi         | POCO X4 GT, Redmi Note 1… | Dimensity 8100     | 2022-05-31   | U      |      105 |     0.002% |
| 714  | a13              |                |                           |                    |              | U      |      105 |     0.002% |
| 716  | e3q              | Samsung        | Galaxy S24 Ultra          | Snapdragon 8 Gen 3 | 2024-01-24   | U      |      104 |     0.002% |
| 717  | treble           |                |                           |                    |              | U      |      103 |     0.002% |
| 717  | beyond0          | Samsung        | Galaxy S10e               | Exynos 9820        | 2019-03-08   | U      |      103 |     0.002% |
| 719  | m1971            | Meizu          | 16s                       | Snapdragon 855     | 2019-04-01   | U      |      102 |     0.002% |
| 719  | h918             | LG             | V20 (T-Mobile)            | Snapdragon 820     | 2016-10-01   | D      |      102 |     0.002% |
| 719  | h870             | LG             | G6 (EU Unlocked)          | Snapdragon 821     | 2017-02-01   | D      |      102 |     0.002% |
| 719  | a9y18qlte        | Samsung        | Galaxy A9 (2018) (SM-A92… | Snapdragon 660     | 2018-11-01   | U      |      102 |     0.002% |
| 719  | a04e             | Samsung        | Galaxy A04e               | Helio P35          | 2022-11-07   | U      |      102 |     0.002% |
| 724  | tetris           | Nothing        | CMF Phone 1               | Dimensity 7300     | 2024-07-09   | U      |      101 |     0.002% |
| 724  | p10bio           |                |                           |                    |              | U      |      101 |     0.002% |
| 724  | oscar            | Realme         | Realme 9 Pro 5G, Realme … | Snapdragon 695     | 2022-02-23   | O      |      101 |     0.002% |
| 724  | Onyx             | OnePlus        | X                         | Snapdragon 801     | 2015-10-29   | U      |      101 |     0.002% |
| 728  | star2qltesq      | Samsung        | Galaxy S9+ USA (SM-G965U) | Snapdragon 845     | 2018-03-01   | U      |      100 |     0.002% |
| 729  | karatep          | Lenovo         | K6 Note, K6 Plus          | Snapdragon 430     | 2016-12-01   | U      |       99 |     0.002% |
| 729  | afyonltecan      | Samsung        | Galaxy Core LTE           | Snapdragon 400     | 2014-05-01   | U      |       99 |     0.002% |
| 731  | lt01lte          | Samsung        | Galaxy Tab 3 (SM-T315)    | Exynos 4212 Dual   | 2013-07-01   | U      |       98 |     0.002% |
| 731  | g0q              |                |                           |                    |              | U      |       98 |     0.002% |
| 731  | P024             | ASUS           | ZenPad 8.0 (Z380KL)       | Snapdragon 410     | 2015-07-01   | D      |       98 |     0.002% |
| 734  | xdplus           | GPD            | XD Plus                   | MediaTek MT8176    | 2018-04-01   | U      |       97 |     0.002% |
| 734  | i9152            | Samsung        | Galaxy Mega 5.8 Duos (I9… | Broadcom BCM28155  | 2013-05-01   | U      |       97 |     0.002% |
| 734  | beyond1q         | Samsung        | Galaxy S10 (SM-G973U)     | Snapdragon 855     | 2019-03-08   | U      |       97 |     0.002% |
| 737  | r9q              | Samsung        | Galaxy S21 FE 5G          | Snapdragon 888 5G  | 2022-01-07   | U      |       96 |     0.002% |
| 738  | i9105p           | Samsung        | Galaxy S II Plus (I9105)  | Broadcom BC28155   | 2013-02-01   | U      |       94 |     0.002% |
| 738  | a03s             | Samsung        | Galaxy A03s               | Helio P35          | 2021-08-18   | U      |       94 |     0.002% |
| 740  | kansas           | Motorola       | moto g (2025), moto g pl… |                    |              | U      |       93 |     0.002% |
| 740  | huashan          | Sony           | Xperia SP                 | Snapdragon S4 Pro  | 2013-04-01   | D      |       93 |     0.002% |
| 740  | a23              | Samsung        | Galaxy A23                | Snapdragon 680 4G  | 2022-03-25   | U      |       93 |     0.002% |
| 743  | gts7xlwifi       | Samsung        | Galaxy Tab S7+ Wifi       | Snapdragon 865 5G+ | 2020-08-21   | U      |       92 |     0.002% |
| 744  | gt58lte          | Samsung        | Galaxy Tab A 8.0 (SM-T35… | Snapdragon 410     | 2015-05-01   | U      |       91 |     0.002% |
| 744  | X6531            | Infinix        | Hot 50i                   | Helio G81          | 2024-10-01   | U      |       91 |     0.002% |
| 746  | waydroid_kvadra… | virtual        | Waydroid                  | ARM64              |              | U      |       90 |     0.002% |
| 746  | rock             |                |                           |                    |              | U      |       90 |     0.002% |
| 746  | odroidm1         | HardKernel     | ODROID-M1                 | Rockchip RK3568B2  | 2022-04-03   | U      |       90 |     0.002% |
| 749  | berlna           | Motorola       | edge 2021                 | Snapdragon 778G 5G | 2021-08-19   | O      |       89 |     0.002% |
| 749  | a50              | Samsung        | Galaxy A50                | Exynos 9610        | 2019-03-18   | U      |       89 |     0.002% |
| 749  | a32x             | Samsung        | Galaxy A32 5G             | Dimensity 720      | 2021-01-22   | U      |       89 |     0.002% |
| 752  | tank             |                |                           |                    |              | U      |       88 |     0.002% |
| 752  | nashc            | Realme         | 8                         | Helio G95          | 2021-03-25   | U      |       88 |     0.002% |
| 752  | d1q              |                |                           |                    |              | U      |       88 |     0.002% |
| 752  | axolotl          | SHIFT          | SHIFT6mq                  | Snapdragon 845     | 2020-06-01   | O      |       88 |     0.002% |
| 752  | aurora           | Sony           | Xperia XZ2 Premium        | Snapdragon 845     | 2018-04-01   | O      |       88 |     0.002% |
| 757  | oxford           |                |                           |                    |              | U      |       87 |     0.002% |
| 757  | o7prolte         | Samsung        | Galaxy On7                | Snapdragon 410     | 2015-11-01   | U      |       87 |     0.002% |
| 757  | g710ulm          | LG             | G7 ThinQ (G710ULM/VMX)    | Snapdragon 845     | 2018-05-02   | O      |       87 |     0.002% |
| 760  | icosa_sr         |                |                           |                    |              | U      |       86 |     0.002% |
| 761  | mayfly           | Xiaomi         | Xiaomi 12S                | Snapdragon 8+ Gen1 | 2022-07-01   | O      |       85 |     0.002% |
| 761  | m31s             | Samsung        | Galaxy M31s               | Exynos9611         | 2020-08-06   | U      |       85 |     0.002% |
| 761  | alice            | Huawei         | P8 Lite (ALE-L21)         | Kirin 620          | 2015-05-01   | U      |       85 |     0.002% |
| 761  | a10dd            | Samsung        | A10                       | Exynos 7884        | 2019-03-19   | U      |       85 |     0.002% |
| 765  | dora             | Sony           | Xperia X Performance      | Snapdragon 820     | 2016-07-01   | U      |       84 |     0.002% |
| 765  | Crystal          | Nokia          | 7.09999999999999964472863 | Snapdragon 636     | 2018-10-28   | U      |       84 |     0.002% |
| 767  | waydroid_arm     | virtual        | Waydroid on ARM           | ARM32              |              | U      |       83 |     0.002% |
| 767  | sphynx           | Google         | Pixel C                   | Nvidia Tegra X1    | 2015-12-08   | U      |       83 |     0.002% |
| 769  | samurai          | Realme         | X2 Pro (RMX1931)          | Snapdragon 855+    | 2019-10-01   | U      |       82 |     0.002% |
| 769  | X6833B           | Infinix        | Note 30 (X6833B)          | Helio G99          | 2023-05-22   | U      |       82 |     0.002% |
| 769  | X01AD            | ASUS           | Zenfone Max M2            | Snapdragon 632     | 2018-12-01   | D      |       82 |     0.002% |
| 769  | RMX1971          | Realme         | 5 Pro, Q                  | Snapdragon 712     | 2019-09-01   | U      |       82 |     0.002% |
| 773  | scorpio          | Xiaomi         | Mi Note 2                 | Snapdragon 821     | 2016-11-01   | D      |       81 |     0.002% |
| 773  | mojito           | Xiaomi         | Redmi Note 10             | Snapdragon 678     | 2021-03-16   | U      |       81 |     0.002% |
| 773  | m307f            | Samsung        | Galaxy M30s               | Exynos 9611        | 2019-10-30   | U      |       81 |     0.002% |
| 773  | lime             | Xiaomi         | Redmi 9T, Redmi 9T NFC, … | Snapdragon 662     | 2021-01-18   | U      |       81 |     0.002% |
| 777  | pdx201           | Sony           | Xperia 10 II              | Snapdragon 665     | 2020-05-05   | U      |       80 |     0.002% |
| 777  | h910             | LG             | V20 (AT&T)                | Snapdragon 820     | 2016-10-01   | D      |       80 |     0.002% |
| 777  | c2502t_cm8900pl… | C Idea         | CM8900 Plus               | Snapdragon QT615   | 2025-09-24   | U      |       80 |     0.002% |
| 780  | wt88047x         | Xiaomi         | Redmi 2                   | Snapdragon 410     | 2015-01-01   | U      |       79 |     0.002% |
| 780  | nx551j           | Nubia          | M2                        | Snapdragon 625     | 2017-06-01   | U      |       79 |     0.002% |
| 780  | ether            | Nextbit        | Robin                     | Snapdragon 808     | 2016-02-01   | D      |       79 |     0.002% |
| 783  | x55              | PowKiddy       | X55                       | Rockchip RK3566    | 2023-05-01   | U      |       78 |     0.002% |
| 783  | porg             | NVIDIA         | Jetson Nano [Android TV]… | Tegra X1 (T210)    | 2019-03-18   | O      |       78 |     0.002% |
| 783  | olivelite        | Xiaomi         | Redmi 8A                  | Snapdragon 439     | 2019-09-30   | U      |       78 |     0.002% |
| 783  | axon7            | ZTE            | Axon 7                    | Snapdragon 820     | 2016-06-01   | D      |       78 |     0.002% |
| 787  | mars             | Xiaomi         | Mi 11 Pro                 | Snapdragon 888     | 2021-03-01   | D      |       77 |     0.002% |
| 787  | lithium          | Xiaomi         | Mi MIX                    | Snapdragon 821     | 2016-10-01   | D      |       77 |     0.002% |
| 787  | j23g             | Samsung        | Galaxy J2 (SM-J200H)      | Exynos 3475 Quad   | 2015-09-01   | U      |       77 |     0.002% |
| 787  | eqs              | Motorola       | edge 30 ultra             | Snapdragon 8+ Gen1 | 2022-09-01   | O      |       77 |     0.002% |
| 787  | a20e             | Samsung        | Galaxy A20e               | Exynos 7884        | 2019-05-01   | U      |       77 |     0.002% |
| 787  | X6739            | Infinix        | GT 10 Pro                 | Dimensity 8050     | 2023-08-13   | U      |       77 |     0.002% |
| 793  | chuwi_vi10plus   | Chuwi          | Vi10 Plus, Hi10 Plus, Hi… | Atom X5 Z8350      | 2016-10-02   | U      |       76 |     0.002% |
| 793  | asteroids        | Nothing        | Phone (3a)                | Snapdragon 7s Gen… | 2025-03-11   | U      |       76 |     0.002% |
| 795  | nora             | Motorola       | Moto E5, Moto E (5th Gen… | Snapdragon 425     | 2018-05-01   | U      |       75 |     0.002% |
| 795  | a22x             | Samsung        | Galaxy A22 5G             | Dimensity 700      | 2021-06-24   | U      |       75 |     0.002% |
| 797  | wade             | Dynalink       | TV Box 4K (2021)          | Amlogic S905Y2     | 2021-06-01   | O      |       74 |     0.002% |
| 797  | odessa           | Motorola       | Moto G9 Plus              | Snapdragon 730G    | 2020-09-07   | U      |       74 |     0.002% |
| 797  | judyp            | LG             | V35 ThinQ                 | Snapdragon 845     | 2018-05-30   | O      |       74 |     0.002% |
| 797  | Pacman           | Nothing        | Phone (2a)                | Dimensity 7200 Pro | 2024-03-12   | U      |       74 |     0.002% |
| 801  | citrus           | Xiaomi         | POCO M3                   | Snapdragon 662     | 2020-11-27   | U      |       73 |     0.002% |
| 801  | caihong          | OnePlus        | Pad Pro                   | Snapdragon 8 Gen3  | 2024-06-29   | O      |       73 |     0.002% |
| 803  | wt89536          | YU             | Yureka 2                  | Snapdragon 625     | 2017-09-01   | U      |       72 |     0.002% |
| 803  | olives           | Xiaomi         | Redmi 8, Redmi 8A, Redmi… | Snapdragon 439     | 2019-10-12   | U      |       72 |     0.002% |
| 803  | everpal          | Xiaomi         | Redmi Note 11T, Redmi 11… | Dimensity 810      | 2021-12-07   | U      |       72 |     0.002% |
| 803  | casuarina        | Vsmart         | Joy 3, Joy 3+             | Snapdragon 632     | 2020-02-14   | O      |       72 |     0.002% |
| 803  | a13x             | Samsung        | Galaxy A13 5G             | Dimensity 700 5G   | 2021-12-03   | U      |       72 |     0.002% |
| 808  | nx595j           | Nubia          | Z17                       | Snapdragon 835     | 2017-06-01   | U      |       71 |     0.002% |
| 808  | gale             | Xiaomi         | Redmi 13C (4G), Poco C65  | Helio G85          | 2023-11-10   | U      |       71 |     0.002% |
| 808  | c1s              | Samsung        | Galaxy Note20 (SM-N980F)  | Exynos 990         | 2020-08-21   | U      |       71 |     0.002% |
| 808  | a6plte           | Samsung        | Galaxy A6+ (2018)         | Snapdragon 450     | 2018-05-01   | U      |       71 |     0.002% |
| 808  | Dragon           | Google         | Pixel C                   | Nvidia Tegra X1    | 2015-12-08   | U      |       71 |     0.002% |
| 813  | kyleprods        | Samsung        | Galaxy S Duos 2 (S7582)   | Broadcom BCM21664T | 2013-12-01   | U      |       70 |     0.002% |
| 814  | q4q              | Samsung        | Galaxy Z Fold4, Galaxy F… | Snapdragon 8+ Gen… | 2022-08-25   | U      |       69 |     0.002% |
| 814  | bitra            | Realme         | GT Neo 2                  | Snapdragon 870 5G  | 2021-09-28   | U      |       69 |     0.002% |
| 814  | LH7n             | TECNO          | Pova 5 (LH7n)             | Helio G99          | 2023-07-01   | U      |       69 |     0.002% |
| 817  | sweet_k6a        | Xiaomi         | Redmi Note 12 Pro 4G      | Snapdragon 732G    | 2023-04-11   | U      |       68 |     0.002% |
| 817  | pocket2          | Retroid        | Pocket 2                  | MediaTek mt6580a   | 2020-08-01   | U      |       68 |     0.002% |
| 817  | nobleltejv       | Samsung        | Galaxy Note 5 (SM-N920C)  | Exynos 7420 Octa   | 2015-09-01   | U      |       68 |     0.002% |
| 817  | A6020            | Lenovo         | Vibe K5, Vibe K5 Plus     | Snapdragon 415     | 2016-04-01   | D      |       68 |     0.002% |
| 821  | j7eltexx         | Samsung        | Galaxy J7 (2015) (SM-J70… | Exynos 7580        | 2015-07-16   | U      |       67 |     0.002% |
| 821  | ferrari          | Xiaomi         | Mi 4i                     | Snapdragon 615     | 2015-04-01   | U      |       67 |     0.002% |
| 821  | b4q              | Samsung        | Galaxy Z Flip 4 5G        | Snapdragon 8+ Gen… | 2022-08-25   | U      |       67 |     0.002% |
| 824  | m51              | Samsung        | M51                       | Snapdragon 730G    | 2020-09-11   | U      |       66 |     0.002% |
| 824  | GM9PRO_sprout    | General Mobile | GM9 Pro                   | Snapdragon 660     | 2018-09-01   | U      |       66 |     0.002% |
| 826  | tate             | Amazon         | Kindle Fire HD 7" (2nd G… | OMAP 4460 HS       | 2012-09-14   | U      |       65 |     0.002% |
| 826  | perry            | Motorola       | Moto E4 (US model)        | Snapdragon 427     | 2017-06-01   | U      |       65 |     0.002% |
| 826  | klteactivexx     | Samsung        | Galaxy S5 Active (G870F)  | Snapdragon 801     | 2014-12-01   | D      |       65 |     0.002% |
| 826  | gprimeltexx      | Samsung        | Galaxy Grand Prime (G530… | Snapdragon 410     | 2014-10-01   | U      |       65 |     0.002% |
| 826  | a31              | Samsung        | Galaxy A31                | Helio P65          | 2020-04-27   | U      |       65 |     0.002% |
| 826  | a30s             | Samsung        | Galaxy A30                | Exynos 7904        | 2019-09-11   | U      |       65 |     0.002% |
| 826  | Daredevil        | Nokia          | 7.20000000000000017763568 | Snapdragon 660     | 2019-09-23   | U      |       65 |     0.002% |
| 826  | A001D            | ASUS           | ZenFone Max Shot, ZenFon… | Snapdragon SiP 1   | 2019-03-01   | U      |       65 |     0.002% |
| 834  | zippo            | Lenovo         | Z6 Pro                    | Snapdragon 855     | 2019-09-11   | O      |       64 |     0.001% |
| 834  | p6800            | Samsung        | Galaxy Tab 7.7 (P6800)    | Exynos 4 Dual 4210 | 2011-12-01   | U      |       64 |     0.001% |
| 834  | nx611j           | Nubia          | Z18 Mini                  | Snapdragon 660     | 2018-04-01   | O      |       64 |     0.001% |
| 834  | kingdom          | Lenovo         | Vibe Z2 Pro               | Snapdragon 801     | 2014-09-01   | D      |       64 |     0.001% |
| 834  | jd2019           | Lenovo         | Z5s                       | Snapdragon 710     | 2018-12-24   | U      |       64 |     0.001% |
| 834  | h830             | LG             | G5 (T-Mobile)             | Snapdragon 820     | 2016-02-01   | D      |       64 |     0.001% |
| 834  | cruiserltesq     | Samsung        | Galaxy S8 Active (SM-G89… | Snapdragon 835     | 2017-08-01   | U      |       64 |     0.001% |
| 834  | condor           | Motorola       | moto e                    | Snapdragon 200     | 2014-05-13   | D      |       64 |     0.001% |
| 834  | benz             | OnePlus        | OnePlus Nord CE4          | Snapdragon 7 Gen 3 | 2024-04-01   | O      |       64 |     0.001% |
| 843  | x6833b           |                |                           |                    |              | U      |       63 |     0.001% |
| 843  | nx569j           | Nubia          | Z17 Mini                  | Snapdragon 652 or… | 2017-04-01   | U      |       63 |     0.001% |
| 843  | cuscoi           | Motorola       | Moto Edge 50 Fusion 5G 2… |                    |              | U      |       63 |     0.001% |
| 843  | amogus_doha      | Motorola       | Moto G8 Plus              | Snapdragon 665     | 2019-10-28   | U      |       63 |     0.001% |
| 843  | Z00xD            | ASUS           | Zenfone 2 Laser           | Snapdragon 410     | 2015-09-01   | U      |       63 |     0.001% |
| 848  | y2q              | Samsung        | Galaxy S20+ 5G            | Snapdragon 865 5G  | 2020-03-06   | U      |       62 |     0.001% |
| 848  | ruby             | Xiaomi         | Redmi Note 12 Pro 5G      | Dimensity 1080     | 2022-11-01   | U      |       62 |     0.001% |
| 848  | liber            | Motorola       | one fusion+, one fusion+… | Snapdragon 730     | 2020-06-01   | D      |       62 |     0.001% |
| 848  | jackpot2lte      | Samsung        | Galaxy A8+ 2018           | Exynos 7885        | 2018-01-01   | U      |       62 |     0.001% |
| 848  | clark            | Motorola       | moto x pure edition (201… | Snapdragon 808     | 2015-09-01   | D      |       62 |     0.001% |
| 848  | aio_otfp         | Lenovo         | Vibe K3 Note              | Mediatek MT6752    | 2015-03-01   | U      |       62 |     0.001% |
| 854  | ursa             | Xiaomi         | Mi 8 Explorer Edition     | Snapdragon 845     | 2018-07-01   | O      |       61 |     0.001% |
| 854  | r5q              | Samsung        | Galaxy S10 Lite           | Snapdragon 855     | 2020-02-03   | U      |       61 |     0.001% |
| 854  | jackpotlte       | Samsung        | Galaxy A8 2018            | Exynos 7885        | 2018-01-01   | U      |       61 |     0.001% |
| 854  | gunnar           | OnePlus        | OnePlus Nord N20          | Snapdragon 695     | 2022-04-28   | O      |       61 |     0.001% |
| 854  | corfur           | Motorola       | moto g71 5G               | Snapdragon 695 5G  | 2022-01-19   | U      |       61 |     0.001% |
| 854  | RMX1911          | Realme         | 5, 5i, 5s                 | Snapdragon 665     | 2019-09-01   | U      |       61 |     0.001% |
| 860  | tilapia          | ASUS           | Nexus 7 3G (2012)         | Tegra 3 T30L       | 2012-07-13   | U      |       60 |     0.001% |
| 860  | on5ltetmo        | Samsung        | Galaxy On5 (SM-G550T)     | Exynos 3475 Quad   | 2015-11-01   | U      |       60 |     0.001% |
| 860  | j1mini3gxw       | Samsung        | Galaxy J1 mini 3G         | Spreadtrum SC8830  | 2016-03-01   | U      |       60 |     0.001% |
| 860  | h3gduoschn       | Samsung        | Galaxy Note 3  (SM-N9002) | Snapdragon 800     | 2013-09-01   | U      |       60 |     0.001% |
| 860  | cupidr           | Xiaomi         | 12                        | Snapdragon 8 Gen 1 | 2021-12-31   | U      |       60 |     0.001% |
| 860  | comet            | Google         | Pixel 9 Pro Fold          | Tensor G4          | 2024-09-04   | O      |       60 |     0.001% |
| 860  | a6000            | Lenovo         | A6000, A6000 Plus         | Snapdragon 410     | 2015-01-28   | U      |       60 |     0.001% |
| 860  | RMX2030          | Realme         | 5i (RMX2030)              | Snapdragon 665     | 2020-01-01   | U      |       60 |     0.001% |
| 868  | andromeda        | Xiaomi         | Mi Mix 3 5g               | Snapdragon 855     | 2019-05-01   | U      |       59 |     0.001% |
| 868  | a24              | Samsung        | Galaxy A24 4G             | Helio G99          | 2023-05-05   | U      |       59 |     0.001% |
| 870  | ks01lte          | Samsung        | Galaxy S4 LTE-A (GT-I950… | Snapdragon 800     | 2013-10-01   | D      |       58 |     0.001% |
| 870  | j1x3gxx          | Samsung        | Galaxy J1 Duos (2016) (S… | Spreadtrum SC9830  | 2016-01-01   | U      |       58 |     0.001% |
| 870  | a04              | Samsung        | Galaxy A04                | Helio P35 MT6765   | 2022-10-10   | U      |       58 |     0.001% |
| 873  | ghost            | Motorola       | moto x                    | Snapdragon S4 Pro  | 2013-08-23   | D      |       57 |     0.001% |
| 873  | PNX_sprout       | Nokia          | 8.1, X7                   | Snapdragon 710     | 2018-12-05   | U      |       57 |     0.001% |
| 875  | maguro           | Google         | Galaxy Nexus GSM          | OMAP 4460          | 2011-10-01   | D      |       56 |     0.001% |
| 875  | RMX1801          | Realme         | Realme 2 Pro              | Snapdragon 660     | 2018-10-11   | D      |       56 |     0.001% |
| 877  | quark            | Motorola       | Moto Maxx, Moto Turbo, D… |                    | 2014-10-01   | U      |       55 |     0.001% |
| 877  | olive            | Xiaomi         | Redmi 8                   | Snapdragon 439     | 2019-10-12   | U      |       55 |     0.001% |
| 877  | nx523j           | Nubia          | Z11 Max                   | Snapdragon 652     | 2016-06-01   | U      |       55 |     0.001% |
| 877  | le_x620          | LeEco          | Le 2                      | Helio X20 MT6797   | 2016-04-01   | U      |       55 |     0.001% |
| 877  | klimtdcm         | Samsung        | Galaxy Tab S 8.4 (SC-03G) | Snapdragon 800     | 2014-07-01   | U      |       55 |     0.001% |
| 877  | jfltespr         | Samsung        | Galaxy S4 (SCH-R970, SPH… | Snapdragon 600     | 2013-04-01   | D      |       55 |     0.001% |
| 877  | e1s              | Samsung        | Galaxy S24 (SM-S921B/N)   | Exynos 2400        | 2024-01-24   | U      |       55 |     0.001% |
| 884  | picasso          | Xiaomi         | Redmi K30 5G              | Snapdragon 765G 5G | 2020-01-07   | U      |       54 |     0.001% |
| 884  | RMX2151L1        | Realme         | 7 (Asia - RMX2151L1)      | Helio G95          | 2020-09-10   | U      |       54 |     0.001% |
| 886  | lunaa            | Realme         | GT Master Edition         | Snapdragon 778G 5G | 2021-07-30   | U      |       53 |     0.001% |
| 886  | kmini3g          | Samsung        | Galaxy S5 mini Duos       | Snapdragon 400     | 2014-08-01   | U      |       53 |     0.001% |
| 886  | james            | Motorola       | Moto E5 Play, Moto E Pla… | Snapdragon 425 or… | 2018-07-01   | U      |       53 |     0.001% |
| 886  | hllte            | Samsung        | Galaxy Note 3 Neo         | Exynos 5260 Hexa   | 2014-02-01   | U      |       53 |     0.001% |
| 886  | f300             | LG             | Vu 3 F300L                | Snapdragon 800     | 2013-10-01   | U      |       53 |     0.001% |
| 886  | P661N            | Itel           | P55 5G, Power 55 5G       | Dimensity 6080     | 2023-10-05   | U      |       53 |     0.001% |
| 892  | zorn             | Xiaomi         | Redmi K80, POCO F7 Pro    | Snapdragon 8 Gen 3 | 2024-11-27   | U      |       52 |     0.001% |
| 892  | pearl            | Xiaomi         | Redmi Note 12T Pro, Redm… | Dimensity 8200 Ul… | 2023-06-01   | U      |       52 |     0.001% |
| 892  | hl3g             | Samsung        | Galaxy Note3 Neo (SM-N75… | Exynos 5260 Hexa   | 2014-02-01   | U      |       52 |     0.001% |
| 892  | h815             | LG             | G4 (International)        | Snapdragon 808     | 2015-06-01   | D      |       52 |     0.001% |
| 892  | enzo             |                |                           |                    |              | U      |       52 |     0.001% |
| 897  | tiare            | Xiaomi         | Redmi GO                  | Snapdragon 425     | 2019-02-01   | U      |       51 |     0.001% |
| 897  | r1q              | Samsung        | Galaxy A80                | Snapdragon 730     | 2019-05-01   | U      |       51 |     0.001% |
| 897  | pro1             | F(x)tec        | Pro¹                      | Snapdragon 835     | 2019-10-01   | O      |       51 |     0.001% |
| 897  | pissarro         | Xiaomi         | Redmi Note 11 Pro, Redmi… | Helio G96          | 2022-02-18   | U      |       51 |     0.001% |
| 897  | k3gxx            | Samsung        | Galaxy S5 (International… | Exynos 5422        | 2014-03-01   | D      |       51 |     0.001% |
| 897  | g0s              | Samsung        | Galaxy S22+ 5G (SM-S906B) | Exynos 2200        | 2022-02-25   | U      |       51 |     0.001% |
| 897  | betalm           | LG             | G8s ThinQ                 | Snapdragon 855     | 2019-06-01   | O      |       51 |     0.001% |
| 897  | a16              | HTC            | Desire 530                | Snapdragon 210     | 2016-03-01   | U      |       51 |     0.001% |
| 897  | TB8504F          | Lenovo         | Tab 4 8 (WiFi)            | Snapdragon 425     | 2017-09-15   | U      |       51 |     0.001% |
| 906  | starqltesq       | Samsung        | Galaxy S9 (SM-G960U)      | Snapdragon 845     | 2018-03-09   | U      |       50 |     0.001% |
| 907  | kltechn          | Samsung        | Galaxy S5 LTE (G9006V/8V) | Snapdragon 801     | 2014-04-01   | D      |       49 |     0.001% |
| 907  | hennessy         | Xiaomi         | Redmi Note 3 (mediatek)   | Snapdragon 650     | 2016-03-03   | U      |       49 |     0.001% |
| 907  | X3               |                |                           |                    |              | U      |       49 |     0.001% |
| 910  | me173x           | ASUS           | Memo Pad HD7 (MT8125)     | Mediatek MT8125    | 2013-07-01   | U      |       48 |     0.001% |
| 910  | 2036             |                |                           |                    |              | U      |       48 |     0.001% |
| 912  | thea             | Motorola       | moto g LTE (2014)         | Snapdragon 400     | 2015-01-01   | D      |       47 |     0.001% |
| 912  | m14x             | Samsung        | Galaxy F14                | Exynos 1330        | 2023-03-30   | U      |       47 |     0.001% |
| 912  | logan2g          | Samsung        | Galaxy Star Pro Duos (GT… | Spreadtrum SC6820  | 2013-10-01   | U      |       47 |     0.001% |
| 912  | ef63             | Pantech        | VEGA Iron 2               | Snapdragon 801     | 2014-05-01   | U      |       47 |     0.001% |
| 912  | dream2qltesq     | Samsung        | Galaxy S8+ (SM-G955U)     | Snapdragon 835     | 2017-04-01   | U      |       47 |     0.001% |
| 912  | beryl            | Xiaomi         | POCO M7 Pro 5G            | Dimensity 7025 Ul… | 2024-12-20   | U      |       47 |     0.001% |
| 918  | greatqlte        | Samsung        | Galaxy Note8 (SM-N9500)   | Snapdragon 835     | 2017-09-01   | U      |       46 |     0.001% |
| 919  | lentislte        | Samsung        | Galaxy S5 LTE-A           | Snapdragon 805     | 2014-07-15   | D      |       45 |     0.001% |
| 919  | breeze           | Xiaomi         | Poco M6 Plus 5G, Redmi 1… | Snapdragon 4 Gen … | 2024-07-12   | U      |       45 |     0.001% |
| 919  | beyond2          | Samsung        | Galaxy S10+ (SM-G975F)    | Exynos 9820 Octa   | 2019-03-08   | U      |       45 |     0.001% |
| 919  | a25x             | Samsung        | Galaxy A25 5G             | Exynos 1280        | 2023-12-16   | U      |       45 |     0.001% |
| 923  | malachite        | Xiaomi         | Redmi Note 14 Pro 5G, PO… | Dimensity 7300 Ul… | 2025-01-15   | U      |       44 |     0.001% |
| 923  | denniz           | OnePlus        | Nord 2 5G                 | Dimensity 1200 (6… | 2021-07-28   | U      |       44 |     0.001% |
| 923  | RMX3852          | Realme         | GT Neo6                   | Snapdragon 8s Gen… | 2024-05-09   | U      |       44 |     0.001% |
| 923  | MT6893           |                |                           | Dimensity 1200 (M… | 2021-01-19   | U      |       44 |     0.001% |
| 923  | 2027             |                |                           |                    |              | U      |       44 |     0.001% |
| 928  | zeekr            | Motorola       | Razr 40 Ultra             | Snapdragon 8+ Gen… | 2023-06-05   | U      |       43 |    0.0010% |
| 928  | rhannah          | Motorola       | moto e5 plus (XT1924-1/2… | Snapdragon 425     | 2018-05-01   | D      |       43 |    0.0010% |
| 928  | radxa0           | Radxa          | Zero (Android TV)         | Amlogic S905Y2     | 2020-12-01   | O      |       43 |    0.0010% |
| 928  | r0s              | Samsung        | Galaxy S22 (SM-S901B)     | Snapdragon 8 Gen 1 | 2022-02-25   | U      |       43 |    0.0010% |
| 928  | mediapadm5lte    | Huawei         | Huawei MediaPad M5 lite   | Kirin 659          | 2018-10-01   | U      |       43 |    0.0010% |
| 928  | kltedcmactive    | Samsung        | Galaxy S5 Active (G870A)  | Snapdragon 801     | 2014-05-01   | U      |       43 |    0.0010% |
| 928  | eyeul            | HTC            | Desire Eye                | Snapdragon 801     | 2014-11-01   | U      |       43 |    0.0010% |
| 935  | psyche           | Xiaomi         | 12X                       | Snapdragon 870 5G  | 2021-12-31   | U      |       42 |    0.0010% |
| 935  | m01q             | Samsung        | Galaxy M01                | Snapdragon 439     | 2020-06-02   | U      |       42 |    0.0010% |
| 935  | frd              | Huawei         | Honor 8                   | Kirin 950          | 2016-07-01   | U      |       42 |    0.0010% |
| 935  | eagle            | Sony           | Xperia M2                 | Snapdragon 400 (2… | 2014-05-01   | U      |       42 |    0.0010% |
| 935  | a13ve            | Samsung        | Galaxy A13 (SM-A137F)     | Helio G80          | 2022-07-01   | U      |       42 |    0.0010% |
| 935  | TB3710F          | Lenovo         | Tab 3 710f                | Mediatek MT8161    | 2016-04-01   | U      |       42 |    0.0010% |
| 941  | j7duolte         | Samsung        | Galaxy J7 Duo (SM-J720F/… | Exynos 7885        | 2018-04-01   | U      |       41 |    0.0010% |
| 941  | halo             | Lenovo         | Legion Y70                | Snapdragon 8+ Gen… | 2022-08-23   | U      |       41 |    0.0010% |
| 941  | gprimelte        | Samsung        | Galaxy Grand Prime        | Snapdragon 410     | 2014-10-01   | U      |       41 |    0.0010% |
| 941  | a5y17ltecan      | Samsung        | Galaxy A5 (2017) (SM-A52… | Exynos 7880        | 2017-01-01   | U      |       41 |    0.0010% |
| 945  | vs995            | LG             | V20 (Verizon)             | Snapdragon 820     | 2016-10-01   | D      |       40 |    0.0009% |
| 945  | rubens           | Xiaomi         | Redmi K50                 | Dimensity 8100     | 2022-03-22   | U      |       40 |    0.0009% |
| 945  | r0q              | Samsung        | Galaxy S22 5G             | Snapdragon 8 Gen 1 | 2022-02-25   | U      |       40 |    0.0009% |
| 945  | corot            | Xiaomi         | Redmi K60 Ultra           | Dimensity 9200+ (… | 2023-08-15   | U      |       40 |    0.0009% |
| 945  | a10s             | Samsung        | Galaxy M01s               | Helio P22          | 2020-07-16   | U      |       40 |    0.0009% |
| 945  | TB2X30L          | Lenovo         | Tab2 A10-30L (TB2-X30L)   | Snapdragon 210     | 2015-09-01   | U      |       40 |    0.0009% |
| 945  | RMX2001          | Realme         | 6                         | Helio G90T (12 nm) | 2020-03-11   | U      |       40 |    0.0009% |
| 945  | Amber            | Yandex         | Phone                     | Snapdragon 630     | 2018-12-01   | D      |       40 |    0.0009% |
| 953  | vns              | Huawei         | P9 Lite, G9 Lite, Honor … | Kirin 650 (16 nm)  | 2016-05-15   | U      |       39 |    0.0009% |
| 953  | vela             | Xiaomi         | Mi CC9 Meitu Edition      | Snapdragon 710     | 2019-09-01   | O      |       39 |    0.0009% |
| 953  | mi439            | Xiaomi         | Redmi 8A Dual             | Snapdragon 439     | 2019-10-01   | U      |       39 |    0.0009% |
| 953  | m307fn           | Samsung        | M30s (SM-M307FN)          | Exynos 9611 (10 n… | 2019-10-30   | U      |       39 |    0.0009% |
| 953  | find7            | OPPO           | Find 7a, Find 7s          | Snapdragon 801     | 2014-03-19   | D      |       39 |    0.0009% |
| 953  | charlotte        | Huawei         | P20 Pro                   | Kirin 970          | 2018-04-01   | D      |       39 |    0.0009% |
| 953  | a14x             | Samsung        | Galaxy A14 5G             | Exynos 1330        | 2023-01-12   | U      |       39 |    0.0009% |
| 953  | RMX1805          | Realme         | 2 Pro                     | Snapdragon 660 (1… | 2018-10-01   | U      |       39 |    0.0009% |
| 961  | zerofltecan      | Samsung        | Galaxy S6 (SM-G920F)      | Exynos 7420 Octa   | 2015-04-01   | U      |       38 |    0.0009% |
| 961  | us996            | LG             | V20 (GSM Unlocked)        | Snapdragon 820     | 2016-10-01   | D      |       38 |    0.0009% |
| 961  | t6               | HTC            | One Max (GSM)             | Snapdragon 600     | 2013-10-01   | D      |       38 |    0.0009% |
| 961  | star2qltecs      | Samsung        | Galaxy S9+ (SM-G965W)     | Snapdragon 845     | 2018-03-01   | U      |       38 |    0.0009% |
| 961  | sltexx           | Samsung        | Galaxy Alpha              | Exynos 5430 Octa   | 2014-09-01   | U      |       38 |    0.0009% |
| 961  | kylepro          | Samsung        | Galaxy Trend Plus (GT-S7… | Broadcom BCM21664  | 2013-12-02   | U      |       38 |    0.0009% |
| 961  | fde_x86_64       |                |                           | x86_64             |              | U      |       38 |    0.0009% |
| 961  | a20s             | Samsung        | Galaxy A20s               | Snapdragon 450     | 2019-10-05   | U      |       38 |    0.0009% |
| 961  | Z500             |                |                           |                    |              | U      |       38 |    0.0009% |
| 961  | Z00T             | ASUS           | Zenfone 2 Laser (1080p),… | Snapdragon 615     | 2015-11-01   | D      |       38 |    0.0009% |
| 961  | PAN_sprout       | Nokia          | 4.20000000000000017763568 | Snapdragon 439     | 2019-05-07   | U      |       38 |    0.0009% |
| 972  | zizhan           | Xiaomi         | MIX Fold 2                | Snapdragon 8+ Gen1 | 2022-08-11   | O      |       37 |    0.0009% |
| 972  | m30lte           | Samsung        | Galaxy M30                | Exynos 7904 (14 n… | 2019-03-07   | U      |       37 |    0.0009% |
| 972  | loganreltexx     | Samsung        | Galaxy Ace 3 LTE (S7275)  | Snapdragon 400     | 2013-07-01   | U      |       37 |    0.0009% |
| 972  | e8               | HTC            | One E8                    | Snapdragon 801 (2… | 2014-06-01   | U      |       37 |    0.0009% |
| 972  | cezanne          | Xiaomi         | Redmi K30 Ultra           | Dimensity 1000+ (… | 2020-08-14   | U      |       37 |    0.0009% |
| 972  | a3core           |                |                           |                    |              | U      |       37 |    0.0009% |
| 972  | OP4F2F           | OPPO           | A15s                      | Helio P35          | 2020-12-18   | U      |       37 |    0.0009% |
| 979  | zangyapro        | BQ             | Aquaris X2 Pro            | Snapdragon 626     | 2017-06-01   | D      |       36 |    0.0008% |
| 979  | starqltecs       | Samsung        | Galaxy S9 (SM-G960W)      | Snapdragon 845 (1… | 2018-03-09   | U      |       36 |    0.0008% |
| 979  | X6532            |                |                           |                    |              | U      |       36 |    0.0008% |
| 982  | taoyao           | Xiaomi         | 12 Lite                   | Snapdragon 778G    | 2022-07-11   | U      |       35 |    0.0008% |
| 982  | memul            | HTC            | One Mini 2                | Snapdragon 400 (2… | 2014-05-01   | U      |       35 |    0.0008% |
| 982  | j2xlte           | Samsung        | J2 (2016)                 | Spreadtrum SC8830  | 2016-07-01   | U      |       35 |    0.0008% |
| 982  | androidbox       |                |                           |                    |              | U      |       35 |    0.0008% |
| 982  | a23xq            |                |                           |                    |              | U      |       35 |    0.0008% |
| 987  | venice           |                |                           |                    |              | U      |       34 |    0.0008% |
| 987  | star             |                |                           |                    |              | U      |       34 |    0.0008% |
| 987  | parker           | Motorola       | one zoom                  | Snapdragon 675     | 2019-09-05   | D      |       34 |    0.0008% |
| 987  | p6200            |                |                           |                    |              | U      |       34 |    0.0008% |
| 987  | j5xnltexx        |                |                           |                    |              | U      |       34 |    0.0008% |
| 987  | T00F             |                |                           |                    |              | U      |       34 |    0.0008% |
| 987  | ASUS_X00AD_2     | ASUS           | ZenFone Go (ZB500KL)      | Snapdragon 410 (2… | 2016-10-01   | U      |       34 |    0.0008% |
| 987  | 2026             |                |                           |                    |              | U      |       34 |    0.0008% |
| 995  | ziti             |                |                           |                    |              | U      |       33 |    0.0008% |
| 995  | z3q              | Samsung        | Galaxy S20 Ultra 5G       | Snapdragon 865 5G  | 2020-03-06   | U      |       33 |    0.0008% |
| 995  | tiro             |                |                           |                    |              | U      |       33 |    0.0008% |
| 995  | smi              | Motorola       | Razr I (XT890)            | Atom Z2460         | 2012-10-01   | U      |       33 |    0.0008% |
| 995  | roth             | NVIDIA         | Shield Portable           | Tegra 4 (T114)     | 2013-07-31   | D      |       33 |    0.0008% |
| 995  | ivy              | Sony           | Xperia Z3+                | Snapdragon 810     | 2015-06-01   | D      |       33 |    0.0008% |
| 995  | e8d              | HTC            | One E8 (dual SIM)         | Snapdragon 801 (2… | 2014-06-01   | U      |       33 |    0.0008% |
| 995  | bloomq           | Samsung        | Galaxy Z Flip             | Snapdragon 855+    | 2020-02-14   | U      |       33 |    0.0008% |
| 1003 | rubyx            |                |                           |                    |              | U      |       32 |    0.0007% |
| 1003 | pele             |                |                           |                    |              | U      |       32 |    0.0007% |
| 1003 | hiae             | HTC            | One A9                    | Snapdragon 617     | 2015-10-20   | D      |       32 |    0.0007% |
| 1003 | h872             | LG             | G6 (T-Mobile)             | Snapdragon 821     | 2017-02-01   | D      |       32 |    0.0007% |
| 1003 | delos3geur       |                |                           |                    |              | U      |       32 |    0.0007% |
| 1003 | d2att            | Samsung        | Galaxy S III (AT&T)       | Snapdragon S4 Plus | 2012-06-28   | D      |       32 |    0.0007% |
| 1003 | a3xeltexx        |                |                           |                    |              | U      |       32 |    0.0007% |
| 1003 | Z00A             | ASUS           | Zenfone 2 (1080p)         | Atom Z3580         | 2015-03-01   | D      |       32 |    0.0007% |
| 1003 | OP4863           | OnePlus        | 13                        | Snapdragon 8 Elit… | 2024-11-01   | U      |       32 |    0.0007% |
| 1003 | K2               |                |                           |                    |              | U      |       32 |    0.0007% |
| 1013 | x3               |                |                           |                    |              | U      |       31 |    0.0007% |
| 1013 | star2lteks       | Samsung        | Galaxy S9+ (SM-G965N)     | Exynos 9 Octa 981… | 2018-03-01   | U      |       31 |    0.0007% |
| 1013 | spartan          |                |                           |                    |              | U      |       31 |    0.0007% |
| 1013 | m2note           |                |                           |                    |              | U      |       31 |    0.0007% |
| 1013 | l01k             | LG             | V30 (Japan)               | Snapdragon 835     | 2017-08-01   | O      |       31 |    0.0007% |
| 1013 | gts7xl           |                |                           |                    |              | U      |       31 |    0.0007% |
| 1013 | dm2q             | Samsung        | Galaxy S23+ (SM-S9160)    | Snapdragon 8 Gen … | 2023-02-01   | U      |       31 |    0.0007% |
| 1013 | a5dwg            |                |                           |                    |              | U      |       31 |    0.0007% |
| 1021 | paella           | BQ             | Aquaris X5                | Snapdragon 412     | 2015-10-14   | D      |       30 |    0.0007% |
| 1021 | nobleltezt       |                |                           |                    |              | U      |       30 |    0.0007% |
| 1021 | ef59             |                |                           |                    |              | U      |       30 |    0.0007% |
| 1021 | dreamqlteue      | Samsung        | Galaxy S8 (SM-G950U1)     | Snapdragon 835     | 2017-04-24   | U      |       30 |    0.0007% |
| 1021 | c2q              |                |                           |                    |              | U      |       30 |    0.0007% |
| 1021 | bathena          | Motorola       | defy 2021                 | Snapdragon 662     | 2021-06-01   | O      |       30 |    0.0007% |
| 1021 | a55x             |                |                           |                    |              | U      |       30 |    0.0007% |
| 1021 | 1951             |                |                           |                    |              | U      |       30 |    0.0007% |
| 1029 | wt86528          |                |                           |                    |              | U      |       29 |    0.0007% |
| 1029 | hi6250           |                |                           |                    |              | U      |       29 |    0.0007% |
| 1031 | z2_row           |                |                           |                    |              | U      |       28 |    0.0007% |
| 1031 | w7               | LG             | L90                       | Snapdragon 400     | 2014-02-01   | D      |       28 |    0.0007% |
| 1031 | scale            |                |                           |                    |              | U      |       28 |    0.0007% |
| 1031 | nx606j           | Nubia          | Z18                       | Snapdragon 845     | 2018-09-01   | O      |       28 |    0.0007% |
| 1031 | nx591j           |                |                           |                    |              | U      |       28 |    0.0007% |
| 1031 | ms01lte          |                |                           |                    |              | U      |       28 |    0.0007% |
| 1031 | g2m              | LG             | G2 Mini                   | Snapdragon 400     | 2014-04-01   | D      |       28 |    0.0007% |
| 1031 | e53g             |                |                           |                    |              | U      |       28 |    0.0007% |
| 1031 | certus64         |                |                           |                    |              | U      |       28 |    0.0007% |
| 1031 | atom             |                |                           |                    |              | U      |       28 |    0.0007% |
| 1031 | Z00L             | ASUS           | Zenfone 2 Laser (720p)    | Snapdragon 410     | 2015-11-01   | D      |       28 |    0.0007% |
| 1031 | F1               |                |                           |                    |              | U      |       28 |    0.0007% |
| 1043 | ulova            |                |                           |                    |              | U      |       27 |    0.0006% |
| 1043 | m53x             |                |                           |                    |              | U      |       27 |    0.0006% |
| 1043 | jag3gds          | LG             | G3 S                      | Snapdragon 400     | 2014-08-01   | D      |       27 |    0.0006% |
| 1043 | hero2ltektt      |                |                           |                    |              | U      |       27 |    0.0006% |
| 1043 | dream2qlteue     |                |                           |                    |              | U      |       27 |    0.0006% |
| 1043 | arubaslim        |                |                           |                    |              | U      |       27 |    0.0006% |
| 1049 | porsche          |                |                           |                    |              | U      |       26 |    0.0006% |
| 1049 | OP4EFDL1         |                |                           |                    |              | U      |       26 |    0.0006% |
| 1049 | OP4BA5L1         |                |                           |                    |              | U      |       26 |    0.0006% |
| 1049 | OP4B79L1         |                |                           |                    |              | U      |       26 |    0.0006% |
| 1053 | winner           |                |                           |                    |              | U      |       25 |    0.0006% |
| 1053 | star2qlteue      |                |                           |                    |              | U      |       25 |    0.0006% |
| 1053 | sirisu           |                |                           |                    |              | U      |       25 |    0.0006% |
| 1053 | m33x             |                |                           |                    |              | U      |       25 |    0.0006% |
| 1053 | greatqlteue      | Samsung        | Galaxy Note8 SM-N950U1    | Snapdragon 835     | 2017-09-01   | U      |       25 |    0.0006% |
| 1053 | dream2qltecan    |                |                           |                    |              | U      |       25 |    0.0006% |
| 1053 | alphalm          |                |                           |                    |              | U      |       25 |    0.0006% |
| 1053 | KL5              |                |                           |                    |              | U      |       25 |    0.0006% |
| 1053 | 1920             |                |                           |                    |              | U      |       25 |    0.0006% |
| 1062 | sydneym          |                |                           |                    |              | U      |       24 |    0.0006% |
| 1062 | nx619j           | Nubia          | Red Magic Mars            | Snapdragon 845     | 2018-12-01   | O      |       24 |    0.0006% |
| 1062 | lexus            |                |                           |                    |              | U      |       24 |    0.0006% |
| 1062 | d2spr            | Samsung        | Galaxy S III (Sprint)     | Snapdragon S4 Plus | 2012-06-28   | D      |       24 |    0.0006% |
| 1062 | a82xq            |                |                           |                    |              | U      |       24 |    0.0006% |
| 1067 | us996d           | LG             | V20 (GSM Unlocked - Dirt… | Snapdragon 820     | 2016-10-01   | D      |       23 |    0.0005% |
| 1067 | tenet            |                |                           |                    |              | U      |       23 |    0.0005% |
| 1067 | j5ltechn         |                |                           |                    |              | U      |       23 |    0.0005% |
| 1067 | gts9wifi         |                |                           |                    |              | U      |       23 |    0.0005% |
| 1067 | emerald          |                |                           |                    |              | U      |       23 |    0.0005% |
| 1067 | e1q              |                |                           |                    |              | U      |       23 |    0.0005% |
| 1067 | a5ul             |                |                           |                    |              | U      |       23 |    0.0005% |
| 1067 | X00I             |                |                           |                    |              | U      |       23 |    0.0005% |
| 1075 | kltedcm          |                |                           |                    |              | U      |       22 |    0.0005% |
| 1075 | heroltelgt       |                |                           |                    |              | U      |       22 |    0.0005% |
| 1075 | ef60             |                |                           |                    |              | U      |       22 |    0.0005% |
| 1075 | dogo             | Sony           | Xperia ZR                 | Snapdragon S4 Pro  | 2013-06-01   | D      |       22 |    0.0005% |
| 1075 | CK8n             |                |                           |                    |              | U      |       22 |    0.0005% |
| 1080 | ziyi             |                |                           |                    |              | U      |       21 |    0.0005% |
| 1080 | shamrock         |                |                           |                    |              | U      |       21 |    0.0005% |
| 1080 | chef             | Motorola       | one power                 | Snapdragon 636     | 2018-10-10   | D      |       21 |    0.0005% |
| 1083 | poplar_kddi      |                |                           |                    |              | U      |       20 |    0.0005% |
| 1083 | penang           |                |                           |                    |              | U      |       20 |    0.0005% |
| 1083 | kltechnduo       | Samsung        | Galaxy S5 LTE Duos (G900… | Snapdragon 801     | 2014-04-01   | D      |       20 |    0.0005% |
| 1083 | klteaio          | Samsung        | Galaxy S5 LTE (G900AZ/S9… | Snapdragon 801     | 2014-04-11   | D      |       20 |    0.0005% |
| 1083 | amber            |                |                           |                    |              | U      |       20 |    0.0005% |
| 1088 | passion          |                |                           |                    |              | U      |       19 |    0.0004% |
| 1088 | nobleltetmo      |                |                           |                    |              | U      |       19 |    0.0004% |
| 1088 | jagnm            | LG             | G3 Beat                   | Snapdragon 400     | 2014-08-01   | D      |       19 |    0.0004% |
| 1088 | fortunalteub     |                |                           |                    |              | U      |       19 |    0.0004% |
| 1088 | ebba             |                |                           |                    |              | U      |       19 |    0.0004% |
| 1088 | c1q              |                |                           |                    |              | U      |       19 |    0.0004% |
| 1088 | apollopro        |                |                           |                    |              | U      |       19 |    0.0004% |
| 1088 | KJ5              |                |                           |                    |              | U      |       19 |    0.0004% |
| 1096 | udon             |                |                           |                    |              | U      |       18 |    0.0004% |
| 1096 | plato            |                |                           |                    |              | U      |       18 |    0.0004% |
| 1096 | owens            |                |                           |                    |              | U      |       18 |    0.0004% |
| 1096 | odroidgo3        |                |                           |                    |              | U      |       18 |    0.0004% |
| 1096 | m8d              | HTC            | One (M8) Dual SIM         | Snapdragon 801     | 2014-06-01   | D      |       18 |    0.0004% |
| 1096 | juice            |                |                           |                    |              | U      |       18 |    0.0004% |
| 1096 | a33x             |                |                           |                    |              | U      |       18 |    0.0004% |
| 1096 | X00H             |                |                           |                    |              | U      |       18 |    0.0004% |
| 1104 | zangya           | BQ             | Aquaris X2                | Snapdragon 636     | 2018-05-01   | D      |       17 |    0.0004% |
| 1104 | tsubasa          | Sony           | Xperia V                  | Snapdragon S4      | 2012-09-01   | D      |       17 |    0.0004% |
| 1104 | r7sf             | OPPO           | R7s (International)       | Snapdragon 615     | 2015-11-01   | D      |       17 |    0.0004% |
| 1104 | piccolo          | BQ             | Aquaris M5                | Snapdragon 615     | 2015-08-01   | D      |       17 |    0.0004% |
| 1104 | j5ltekx          |                |                           |                    |              | U      |       17 |    0.0004% |
| 1104 | houji            |                |                           |                    |              | U      |       17 |    0.0004% |
| 1104 | h96_max_x3       |                |                           |                    |              | U      |       17 |    0.0004% |
| 1111 | wly              |                |                           |                    |              | U      |       16 |    0.0004% |
| 1111 | serranoltespr    |                |                           |                    |              | U      |       16 |    0.0004% |
| 1111 | h815_usu         |                |                           |                    |              | U      |       16 |    0.0004% |
| 1111 | eqe              |                |                           |                    |              | U      |       16 |    0.0004% |
| 1111 | cs02             |                |                           |                    |              | U      |       16 |    0.0004% |
| 1111 | X6871            |                |                           |                    |              | U      |       16 |    0.0004% |
| 1117 | ulysse           |                |                           |                    |              | U      |       15 |    0.0003% |
| 1117 | sisleyr          |                |                           |                    |              | U      |       15 |    0.0003% |
| 1117 | ph2n             |                |                           |                    |              | U      |       15 |    0.0003% |
| 1117 | paros            |                |                           |                    |              | U      |       15 |    0.0003% |
| 1117 | lv517            |                |                           |                    |              | U      |       15 |    0.0003% |
| 1117 | himaul           | HTC            | One M9 (GSM)              | Snapdragon 810     | 2015-03-01   | D      |       15 |    0.0003% |
| 1117 | f1f              | OPPO           | F1 (International)        | Snapdragon 615     | 2016-01-01   | D      |       15 |    0.0003% |
| 1117 | ctwo             |                |                           |                    |              | U      |       15 |    0.0003% |
| 1125 | z3dual           |                |                           |                    |              | U      |       14 |    0.0003% |
| 1125 | vitamin          |                |                           |                    |              | U      |       14 |    0.0003% |
| 1125 | tbelteskt        |                |                           |                    |              | U      |       14 |    0.0003% |
| 1125 | nx609j           | Nubia          | Red Magic                 | Snapdragon 835     | 2018-04-01   | D      |       14 |    0.0003% |
| 1125 | mint             | Sony           | Xperia T                  | Snapdragon S4      | 2012-09-01   | D      |       14 |    0.0003% |
| 1125 | figo             | Huawei         | P Smart                   | Kirin 659          | 2017-12-01   | D      |       14 |    0.0003% |
| 1125 | a7lte            |                |                           |                    |              | U      |       14 |    0.0003% |
| 1125 | a6010            |                |                           |                    |              | U      |       14 |    0.0003% |
| 1133 | rio              |                |                           |                    |              | U      |       13 |    0.0003% |
| 1133 | hayabusa         | Sony           | Xperia TX                 | Snapdragon S4      | 2012-08-01   | D      |       13 |    0.0003% |
| 1133 | h812_usu         |                |                           |                    |              | U      |       13 |    0.0003% |
| 1133 | P1m              |                |                           |                    |              | U      |       13 |    0.0003% |
| 1137 | willow           |                |                           |                    |              | U      |       12 |    0.0003% |
| 1137 | r7plus           | OPPO           | R7 Plus (International)   | Snapdragon 615     | 2015-05-01   | D      |       12 |    0.0003% |
| 1137 | jflteatt         | Samsung        | Galaxy S4 (SGH-I337)      | Snapdragon 600     | 2013-04-01   | D      |       12 |    0.0003% |
| 1137 | gohan            | BQ             | Aquaris X5 Plus           | Snapdragon 652     | 2016-07-01   | D      |       12 |    0.0003% |
| 1137 | anne             | Huawei         | P20 Lite                  | Kirin 659          | 2018-03-01   | D      |       12 |    0.0003% |
| 1137 | a53gxx           |                |                           |                    |              | U      |       12 |    0.0003% |
| 1143 | y560             |                |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | prague           |                |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | p7_l10           |                |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | kltevzw          |                |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | j7xlte           |                |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | i9100g           |                |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | f400             | LG             | G3 (Korea)                | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1143 | d852             | LG             | G3 (Canada)               | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1143 | d851             | LG             | G3 (T-Mobile)             | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1143 | d850             | LG             | G3 (AT&T)                 | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1143 | crownqltechn     |                |                           |                    |              | U      |       11 |    0.0003% |
| 1143 | TP1803           | Nubia          | Mini 5G                   | Snapdragon 855     | 2019-04-01   | O      |       11 |    0.0003% |
| 1143 | A5_Pro           |                |                           |                    |              | U      |       11 |    0.0003% |
| 1156 | w5               | LG             | Optimus L70               | Snapdragon 200     | 2014-04-01   | D      |       10 |    0.0002% |
| 1156 | vegetalte        | BQ             | Aquaris E5 4G, Aquaris E… | Snapdragon 410     | 2014-11-01   | D      |       10 |    0.0002% |
| 1156 | odroidn2l        |                |                           |                    |              | U      |       10 |    0.0002% |
| 1156 | nicki            | Sony           | Xperia M                  | Snapdragon S4 Plus | 2013-06-01   | D      |       10 |    0.0002% |
| 1156 | ls990            | LG             | G3 (Sprint)               | Snapdragon 801     | 2014-06-01   | D      |       10 |    0.0002% |
| 1156 | htc_820g_plus    |                |                           |                    |              | U      |       10 |    0.0002% |
| 1156 | coreprimeve3g    |                |                           |                    |              | U      |       10 |    0.0002% |
| 1156 | a5ltexx          |                |                           |                    |              | U      |       10 |    0.0002% |
| 1164 | m8qlul           |                |                           |                    |              | U      |        9 |    0.0002% |
| 1164 | h930             |                |                           |                    |              | U      |        9 |    0.0002% |
| 1164 | frescoltekor     |                |                           |                    |              | U      |        9 |    0.0002% |
| 1164 | caymanslm        | LG             | Velvet                    | Snapdragon 845     | 2020-07-31   | O      |        9 |    0.0002% |
| 1164 | a70s             |                |                           |                    |              | U      |        9 |    0.0002% |
| 1169 | x500             |                |                           |                    |              | U      |        8 |    0.0002% |
| 1169 | urd              |                |                           |                    |              | U      |        8 |    0.0002% |
| 1169 | onc              |                |                           |                    |              | U      |        8 |    0.0002% |
| 1169 | flashlm          |                |                           |                    |              | U      |        8 |    0.0002% |
| 1169 | ef56             |                |                           |                    |              | U      |        8 |    0.0002% |
| 1169 | ahannah          | Motorola       | moto e5 plus (XT1924-3/9) | Snapdragon 430     | 2018-05-01   | D      |        8 |    0.0002% |
| 1169 | Tiare_4_19       |                |                           |                    |              | U      |        8 |    0.0002% |
| 1169 | RMX3242          |                |                           |                    |              | U      |        8 |    0.0002% |
| 1177 | trltexx          |                |                           |                    |              | U      |        7 |    0.0002% |
| 1177 | r5xQ             |                |                           |                    |              | U      |        7 |    0.0002% |
| 1177 | poplar_canada    |                |                           |                    |              | U      |        7 |    0.0002% |
| 1177 | p839v55          |                |                           |                    |              | U      |        7 |    0.0002% |
| 1177 | light            |                |                           |                    |              | U      |        7 |    0.0002% |
| 1177 | kinzie           |                |                           |                    |              | U      |        7 |    0.0002% |
| 1177 | j3xltebmc        |                |                           |                    |              | U      |        7 |    0.0002% |
| 1177 | h811             | LG             | G4 (T-Mobile)             | Snapdragon 808     | 2015-06-01   | D      |        7 |    0.0002% |
| 1177 | caza             |                |                           |                    |              | U      |        7 |    0.0002% |
| 1177 | GM8_sprout       |                |                           |                    |              | U      |        7 |    0.0002% |
| 1187 | wilcoxltexx      |                |                           |                    |              | U      |        6 |    0.0001% |
| 1187 | sltecan          |                |                           |                    |              | U      |        6 |    0.0001% |
| 1187 | osaka            |                |                           |                    |              | U      |        6 |    0.0001% |
| 1187 | maverick         |                |                           |                    |              | U      |        6 |    0.0001% |
| 1187 | kltespr          |                |                           |                    |              | U      |        6 |    0.0001% |
| 1187 | ef71             |                |                           |                    |              | U      |        6 |    0.0001% |
| 1187 | draconis         |                |                           |                    |              | U      |        6 |    0.0001% |
| 1187 | A7010a48         |                |                           |                    |              | U      |        6 |    0.0001% |
| 1195 | x1               |                |                           |                    |              | U      |        5 |    0.0001% |
| 1195 | vidofnir         |                |                           |                    |              | U      |        5 |    0.0001% |
| 1195 | unified7870      |                |                           |                    |              | U      |        5 |    0.0001% |
| 1195 | rs988            | LG             | G5 (US Unlocked)          | Snapdragon 820     | 2016-02-01   | D      |        5 |    0.0001% |
| 1195 | nx589j           |                |                           |                    |              | U      |        5 |    0.0001% |
| 1195 | j5ltexx          |                |                           |                    |              | U      |        5 |    0.0001% |
| 1195 | j3xprolte        |                |                           |                    |              | U      |        5 |    0.0001% |
| 1195 | iris             |                |                           |                    |              | U      |        5 |    0.0001% |
| 1195 | d838             |                |                           |                    |              | U      |        5 |    0.0001% |
| 1195 | agate            |                |                           |                    |              | U      |        5 |    0.0001% |
| 1205 | v1               |                |                           |                    |              | U      |        4 |   0.00009% |
| 1205 | trelte           |                |                           |                    |              | U      |        4 |   0.00009% |
| 1205 | serranolteusc    |                |                           |                    |              | U      |        4 |   0.00009% |
| 1205 | j7ltechn         |                |                           |                    |              | U      |        4 |   0.00009% |
| 1205 | j3ltekx          |                |                           |                    |              | U      |        4 |   0.00009% |
| 1205 | NX679J           |                |                           |                    |              | U      |        4 |   0.00009% |
| 1211 | x1slte           |                |                           |                    |              | U      |        3 |   0.00007% |
| 1211 | vee7             |                |                           |                    |              | U      |        3 |   0.00007% |
| 1211 | sydney           |                |                           |                    |              | U      |        3 |   0.00007% |
| 1211 | sf340n           |                |                           |                    |              | U      |        3 |   0.00007% |
| 1211 | r5               | OPPO           | R5 (International), R5s … | Snapdragon 615     | 2014-12-01   | D      |        3 |   0.00007% |
| 1211 | nemo             |                |                           |                    |              | U      |        3 |   0.00007% |
| 1211 | logan            |                |                           |                    |              | U      |        3 |   0.00007% |
| 1211 | fortuna3gdtv     |                |                           |                    |              | U      |        3 |   0.00007% |
| 1211 | cusco            |                |                           |                    |              | U      |        3 |   0.00007% |
| 1220 | h810_usu         |                |                           |                    |              | U      |        2 |   0.00005% |
| 1220 | Z00RD            |                |                           |                    |              | U      |        2 |   0.00005% |
| 1220 | X5_Max_Pro       |                |                           |                    |              | U      |        2 |   0.00005% |
| 1220 | Samsung Galaxy … |                |                           |                    |              | U      |        2 |   0.00005% |
| 1224 | shamu_t          |                |                           |                    |              | U      |        1 |   0.00002% |
| 1224 | pdx223           |                |                           |                    |              | U      |        1 |   0.00002% |
| 1224 | k11ta_a          |                |                           |                    |              | U      |        1 |   0.00002% |
| 1224 | j7toplteskt      |                |                           |                    |              | U      |        1 |   0.00002% |
| 1224 | find7s           |                |                           |                    |              | U      |        1 |   0.00002% |
| 1224 | e5lte            |                |                           |                    |              | U      |        1 |   0.00002% |
| 1224 | d2refreshspr     |                |                           |                    |              | U      |        1 |   0.00002% |
| 1224 | a71n             |                |                           |                    |              | U      |        1 |   0.00002% |
| 1224 | RMX3461          |                |                           |                    |              | U      |        1 |   0.00002% |
| 1224 | Nightmare        |                |                           |                    |              | U      |        1 |   0.00002% |
|      | Unlisted         |                |                           |                    |              |        |     8562 |      0.20% |
|      | Total            |                |                           |                    |              |        |  4301866 |    100.00% |
---------------------------------------------------------------------------------------------------------------------------------------------

Status codes: O=active official build, D=discontinued official build, U=unofficial build

Manufacturers of devices that run LineageOS
---------------------------------------------------------------------
| Rank |     Maker      | Builds | % Builds | Installs | % Installs |
---------------------------------------------------------------------
| 1    | Samsung        |    327 |    26.5% |  1196928 |     27.82% |
| 2    | Motorola       |     84 |     6.8% |  1141333 |     26.53% |
| 3    | Xiaomi         |    182 |    14.8% |   741644 |     17.24% |
| 4    | OPPO           |     17 |     1.4% |   385229 |      8.95% |
| 5    | Huawei         |     19 |     1.5% |   263485 |      6.12% |
| 6    | virtual        |     12 |     1.0% |   175279 |      4.07% |
| 7    | LG             |     41 |     3.3% |    68126 |      1.58% |
| 8    | Realme         |     24 |     1.9% |    65810 |      1.53% |
| 9    | OnePlus        |     38 |     3.1% |    56974 |      1.32% |
| 10   | Google         |     44 |     3.6% |    49373 |      1.15% |
| 11   | Amazon         |     11 |     0.9% |    42994 |      1.00% |
| 12   | Nintendo       |      2 |     0.2% |    23130 |      0.54% |
| 13   | Sony           |     55 |     4.5% |    15141 |      0.35% |
| 14   | Raspberry Pi   |      3 |     0.2% |    13908 |      0.32% |
| 15   | Lenovo         |     29 |     2.4% |    12620 |      0.29% |
| 16   | unknown        |    222 |    18.0% |     8884 |      0.21% |
| 17   | LeEco          |      4 |     0.3% |     3993 |      0.09% |
| 18   | ASUS           |     17 |     1.4% |     3882 |      0.09% |
| 19   | Nubia          |     11 |     0.9% |     3366 |      0.08% |
| 20   | Fairphone      |      5 |     0.4% |     3269 |      0.08% |
| 21   | ZTE            |      3 |     0.2% |     2296 |      0.05% |
| 22   | HTC            |     15 |     1.2% |     2210 |      0.05% |
| 23   | Nokia          |      8 |     0.6% |     1765 |      0.04% |
| 24   | Nothing        |      5 |     0.4% |     1295 |      0.03% |
| 25   | R36S           |      1 |    0.08% |     1180 |      0.03% |
| 26   | NVIDIA         |      6 |     0.5% |     1137 |      0.03% |
| 27   | Essential      |      1 |    0.08% |     1019 |      0.02% |
| 28   | HardKernel     |      4 |     0.3% |     1015 |      0.02% |
| 29   | Meizu          |      2 |     0.2% |      794 |      0.02% |
| 30   | BQ             |      8 |     0.6% |      687 |      0.02% |
| 31   | Razer          |      2 |     0.2% |      624 |      0.01% |
| 32   | GREE           |      1 |    0.08% |      622 |      0.01% |
| 33   | ZUK            |      2 |     0.2% |      488 |      0.01% |
| 34   | Wingtech       |      1 |    0.08% |      358 |     0.008% |
| 35   | Wileyfox       |      2 |     0.2% |      290 |     0.007% |
| 36   | Infinix        |      3 |     0.2% |      250 |     0.006% |
| 37   | Micromax       |      1 |    0.08% |      212 |     0.005% |
| 38   | F(x)tec        |      2 |     0.2% |      205 |     0.005% |
| 39   | Sharp          |      1 |    0.08% |      148 |     0.003% |
| 40   | Walmart        |      1 |    0.08% |      129 |     0.003% |
| 41   | Solana         |      1 |    0.08% |      110 |     0.003% |
| 42   | GPD            |      1 |    0.08% |       97 |     0.002% |
| 43   | SHIFT          |      1 |    0.08% |       88 |     0.002% |
| 44   | C Idea         |      1 |    0.08% |       80 |     0.002% |
| 45   | Nextbit        |      1 |    0.08% |       79 |     0.002% |
| 46   | PowKiddy       |      1 |    0.08% |       78 |     0.002% |
| 47   | Chuwi          |      1 |    0.08% |       76 |     0.002% |
| 48   | Dynalink       |      1 |    0.08% |       74 |     0.002% |
| 49   | YU             |      1 |    0.08% |       72 |     0.002% |
| 50   | TECNO          |      1 |    0.08% |       69 |     0.002% |
| 51   | Retroid        |      1 |    0.08% |       68 |     0.002% |
| 52   | General Mobile |      1 |    0.08% |       66 |     0.002% |
| 53   | Itel           |      1 |    0.08% |       53 |     0.001% |
| 54   | Pantech        |      1 |    0.08% |       47 |     0.001% |
| 55   | Radxa          |      1 |    0.08% |       43 |    0.0010% |
| 56   | Yandex         |      1 |    0.08% |       40 |    0.0009% |
|      | Unlisted       |      ? |        ? |     8562 |      0.20% |
|      | Total          |   1233 |   100.0% |  4301866 |    100.00% |
---------------------------------------------------------------------

Processors of devices that run LineageOS
---------------------------------------------------------------------
| Rank | Processor Type | Builds | % Builds | Installs | % Installs |
---------------------------------------------------------------------
| 1    | Snapdragon 6   |    170 |    13.8% |  1023493 |     23.79% |
| 2    | Exynos         |    142 |    11.5% |   998280 |     23.21% |
| 3    | Snapdragon 8   |    283 |    23.0% |   610716 |     14.20% |
| 4    | Snapdragon 4   |    127 |    10.3% |   501926 |     11.67% |
| 5    | Snapdragon 7   |     61 |     4.9% |   345567 |      8.03% |
| 6    | Kirin          |     15 |     1.2% |   199490 |      4.64% |
| 7    | X86            |      5 |     0.4% |   154558 |      3.59% |
| 8    | Helio          |     47 |     3.8% |   150792 |      3.51% |
| 9    | Omap           |      5 |     0.4% |    73210 |      1.70% |
| 10   | Dimensity      |     26 |     2.1% |    66306 |      1.54% |
| 11   | Mediatek       |     19 |     1.5% |    45401 |      1.06% |
| 12   | Tegra          |     13 |     1.1% |    29055 |      0.68% |
| 13   | Arm            |      1 |    0.08% |    17538 |      0.41% |
| 14   | Broadcom       |      9 |     0.7% |    15296 |      0.36% |
| 15   | Spreadtrum     |     13 |     1.1% |    13982 |      0.33% |
| 16   | Atom           |      7 |     0.6% |    10897 |      0.25% |
| 17   | Tensor         |     15 |     1.2% |     9199 |      0.21% |
| 18   | unknown        |    221 |    17.9% |     8896 |      0.21% |
| 19   | Snapdragon S   |     20 |     1.6% |     7879 |      0.18% |
| 20   | X86_64         |      5 |     0.4% |     2571 |      0.06% |
| 21   | Qualcomm       |      4 |     0.3% |     1720 |      0.04% |
| 22   | Rockchip       |      3 |     0.2% |     1348 |      0.03% |
| 23   | Snapdragon?    |      1 |    0.08% |     1317 |      0.03% |
| 24   | Amlogic        |      5 |     0.4% |      997 |      0.02% |
| 25   | Snapdragon 2   |      6 |     0.5% |      932 |      0.02% |
| 26   | Arm64          |      3 |     0.2% |      684 |      0.02% |
| 27   | Novathor       |      1 |    0.08% |      636 |      0.01% |
| 28   | Marvell        |      1 |    0.08% |      216 |     0.005% |
| 29   | Nvidia         |      2 |     0.2% |      154 |     0.004% |
| 30   | Exynos9611     |      1 |    0.08% |       85 |     0.002% |
| 31   | Arm32          |      1 |    0.08% |       83 |     0.002% |
| 32   | Snapdragon     |      1 |    0.08% |       80 |     0.002% |
|      | Unlisted       |      ? |        ? |     8562 |      0.20% |
|      | Total          |   1233 |   100.0% |  4301866 |    100.00% |
---------------------------------------------------------------------

Status of LineageOS builds
--------------------------------------------------------
|  Status  | Builds | % Builds | Installs | % Installs |
--------------------------------------------------------
| O        |    243 |    19.7% |  2029112 |     47.17% |
| D        |    242 |    19.6% |   439523 |     10.22% |
| U        |    748 |    60.7% |  1824669 |     42.42% |
| Unlisted |      ? |        ? |     8562 |      0.20% |
| Total    |   1233 |   100.0% |  4301866 |    100.00% |
--------------------------------------------------------

LineageOS versions in active installs
---------------------------------------------------------------
| Rank | Version  | Builds | % Builds | Installs | % Installs |
---------------------------------------------------------------
| 1    | 18.1     |    579 |      47% |  1073710 |     24.96% |
| 2    | 21.0     |    527 |      43% |   990116 |     23.02% |
| 3    | 17.1     |    489 |      40% |   833187 |     19.37% |
| 4    | 20.0     |    521 |      42% |   472624 |     10.99% |
| 5    | 19.1     |    407 |      33% |   418762 |      9.73% |
| 6    | 22.2     |    430 |      35% |   158922 |      3.69% |
| 7    | 14.1     |    382 |      31% |   106510 |      2.48% |
| 8    | 15.1     |    281 |      23% |    84347 |      1.96% |
| 9    | 16.0     |    532 |      43% |    60300 |      1.40% |
| 10   | 23.0     |    270 |      22% |    31305 |      0.73% |
| 11   | 17.0     |     88 |       7% |    23272 |      0.54% |
| 12   | 22.1     |    331 |      27% |    14229 |      0.33% |
| 13   | 18.0     |     92 |       7% |     9883 |      0.23% |
| 14   | 13.0     |    140 |      11% |     8552 |      0.20% |
| 15   | 12.1     |      7 |     0.6% |     1933 |      0.04% |
| 16   | 20.3     |      1 |    0.08% |     1805 |      0.04% |
| 17   | 19.0     |    114 |       9% |     1759 |      0.04% |
| 18   | 22.0     |    117 |       9% |     1751 |      0.04% |
| 19   | 10.0     |     26 |       2% |      193 |     0.004% |
| 20   | 16.1     |      2 |     0.2% |       73 |     0.002% |
| 21   | 15.0     |      3 |     0.2% |       20 |    0.0005% |
| 22   | 20.2     |      2 |     0.2% |       19 |    0.0004% |
| 23   | 15.2     |      1 |    0.08% |       10 |    0.0002% |
| 24   | 24.0     |      1 |    0.08% |        9 |    0.0002% |
| 25   | 14.0     |      3 |     0.2% |        4 |   0.00009% |
| 26   | 25.0     |      1 |    0.08% |        3 |   0.00007% |
| 27   | 17.9     |      1 |    0.08% |        2 |   0.00005% |
| 28   | 21.3     |      1 |    0.08% |        1 |   0.00002% |
|      | Unlisted |      ? |        ? |     8562 |      0.20% |
|      | Total    |   1233 |     100% |  4301866 |    100.00% |
---------------------------------------------------------------

Years when devices running LineageOS were released
-------------------------------------------------------------------
|   Year   |  Status  | Builds | % Builds | Installs | % Installs |
-------------------------------------------------------------------
| 2011     | O        |      0 |       0% |        0 |         0% |
| 2011     | D        |      2 |     0.2% |      596 |      0.01% |
| 2011     | U        |      2 |     0.2% |      215 |     0.005% |
| 2011     | Total    |      4 |     0.3% |      811 |      0.02% |
| 2012     | O        |      0 |       0% |        0 |         0% |
| 2012     | D        |     12 |     1.0% |    13558 |      0.32% |
| 2012     | U        |     13 |     1.1% |    86929 |      2.02% |
| 2012     | Total    |     25 |     2.0% |   100487 |      2.34% |
| 2013     | O        |      0 |       0% |        0 |         0% |
| 2013     | D        |     39 |     3.2% |    32568 |      0.76% |
| 2013     | U        |     26 |     2.1% |    16401 |      0.38% |
| 2013     | Total    |     65 |     5.3% |    48969 |      1.14% |
| 2014     | O        |      0 |       0% |        0 |         0% |
| 2014     | D        |     53 |     4.3% |    27381 |      0.64% |
| 2014     | U        |     54 |     4.4% |    43151 |      1.00% |
| 2014     | Total    |    107 |     8.7% |    70532 |      1.64% |
| 2015     | O        |      2 |     0.2% |      571 |      0.01% |
| 2015     | D        |     45 |     3.6% |    50271 |      1.17% |
| 2015     | U        |     49 |     4.0% |    30831 |      0.72% |
| 2015     | Total    |     96 |     7.8% |    81673 |      1.90% |
| 2016     | O        |      6 |     0.5% |    17460 |      0.41% |
| 2016     | D        |     43 |     3.5% |   226460 |      5.26% |
| 2016     | U        |     51 |     4.1% |   170936 |      3.97% |
| 2016     | Total    |    100 |     8.1% |   414856 |      9.64% |
| 2017     | O        |     17 |     1.4% |   142188 |      3.31% |
| 2017     | D        |     15 |     1.2% |    30850 |      0.72% |
| 2017     | U        |     54 |     4.4% |   354274 |      8.24% |
| 2017     | Total    |     86 |     7.0% |   527312 |     12.26% |
| 2018     | O        |     32 |     2.6% |   360555 |      8.38% |
| 2018     | D        |     23 |     1.9% |    33510 |      0.78% |
| 2018     | U        |     47 |     3.8% |   446418 |     10.38% |
| 2018     | Total    |    102 |     8.3% |   840483 |     19.54% |
| 2019     | O        |     47 |     3.8% |  1271020 |     29.55% |
| 2019     | D        |      4 |     0.3% |    17941 |      0.42% |
| 2019     | U        |     54 |     4.4% |   385709 |      8.97% |
| 2019     | Total    |    105 |     8.5% |  1674670 |     38.93% |
| 2020     | O        |     37 |     3.0% |   166419 |      3.87% |
| 2020     | D        |      5 |     0.4% |     6311 |      0.15% |
| 2020     | U        |     50 |     4.1% |    81212 |      1.89% |
| 2020     | Total    |     92 |     7.5% |   253942 |      5.90% |
| 2021     | O        |     41 |     3.3% |    44540 |      1.04% |
| 2021     | D        |      1 |    0.08% |       77 |     0.002% |
| 2021     | U        |     32 |     2.6% |   171761 |      3.99% |
| 2021     | Total    |     74 |     6.0% |   216378 |      5.03% |
| 2022     | O        |     28 |     2.3% |    11266 |      0.26% |
| 2022     | D        |      0 |       0% |        0 |         0% |
| 2022     | U        |     32 |     2.6% |     6368 |      0.15% |
| 2022     | Total    |     60 |     4.9% |    17634 |      0.41% |
| 2023     | O        |     22 |     1.8% |    11923 |      0.28% |
| 2023     | D        |      0 |       0% |        0 |         0% |
| 2023     | U        |     32 |     2.6% |     9415 |      0.22% |
| 2023     | Total    |     54 |     4.4% |    21338 |      0.50% |
| 2024     | O        |     10 |     0.8% |     3012 |      0.07% |
| 2024     | D        |      0 |       0% |        0 |         0% |
| 2024     | U        |     12 |     1.0% |     1739 |      0.04% |
| 2024     | Total    |     22 |     1.8% |     4751 |      0.11% |
| 2025     | O        |      1 |    0.08% |      158 |     0.004% |
| 2025     | D        |      0 |       0% |        0 |         0% |
| 2025     | U        |      8 |     0.6% |     2055 |      0.05% |
| 2025     | Total    |      9 |     0.7% |     2213 |      0.05% |
| unknown  | U        |    232 |    18.8% |    17255 |      0.40% |
| unknown  | Total    |    232 |    18.8% |    17255 |      0.40% |
| Unlisted | Unlisted |      ? |        ? |     8562 |      0.20% |
| Total    | Total    |   1233 |     100% |  4301866 |       100% |
-------------------------------------------------------------------

Reported on Friday 07 Nov 2025 00:23:55 -04.
Script execution time = 17 minutes 30 seconds
```
