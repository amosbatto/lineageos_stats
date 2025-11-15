`lineageos_stats.php` is a command-line script to download LineageOS 
statistics about the number of builds and installs from 
https://stats.lineageos.org   
It displays more information than is provided by the LineageOS web page,
which only displays builds by their code name and countries by their ISO
codes. This script can search for countries by their English or local
language names and for builds by their device model names. It tallies 
the total builds and installs by country, device manufacturer, processor
family, release year of devices, build status and LineageOS version 
number.   
  
By default the script shows the country list and the build list with 
statistics tables at the end. If information is known about a build 
(device model, manufacturer, processor family, device release year), 
that is displayed in the build list. There is normally 1 build per 
device model, but some builds support multiple device models.
 
Getting the country list is fast, but getting the build list is
very slow because the script has to download over 1300 build pages to
get the data. Unfortunately, LineageOS doesn't provide a complete list 
of all the build code names, so any builds which aren't listed in any of
the country pages are tallied at the end of the list under "Unlisted". 

The status codes for the builds are:  
**O** = active official build,  
**D** = discontinued official build,  
**U** = unofficial build  

The number of installs for versions which are no longer getting security 
updates from Google are tallied under "Unsupported". 
 
**Installation:**   
1. Install the command line interface for PHP 7 or later. ´
2. Install the mbstring, yaml and curl PHP extensions.
3. Download this script from https://github.com/amosbatto/lineageos_stats
   If the ZIP file was downloaded, then decompress it. 
  
In a Debian/Ubuntu/Mint terminal, these commands should work: 
```
sudo apt install php php-mbstring php-yaml php-curl
wget -O los_stats.zip https://github.com/amosbatto/lineageos_stats/archive/refs/heads/main.zip
unzip los_stats.zip -d lineageos_stats
```
  
**Execution:**  
To run the script in a terminal:  
`php lineageos_stats.php`
  
Depending on how you installed PHP, you may have to include the path to 
execute it. For example in Windows:  
`C:\users\bob\php8.3\php.exe lineageos_stats.php` 

**Command line options:**  
```
-c , --country     Display the country list with the number of builds
                   and active installs per country.   
                   Ex: php lineageos_stats.php -c  
                  
-c[XX]             Can specify an optional two letter country code or a
--country=[XX]     country name (in English or local language) to 
                   display stats for a single country.
                   Ex: php lineageos_stats.php -cUS  
                   Ex: php lineageos_stats.php --country=BR  
                   Ex: php lineageos_stats.php -c"United Arab Emirates"
                  
-b , --build       Display the build list.  
                   Ex: php lineageos_stats.php -b  
  
-b[NAME]           Can specify a build codename or a device model name 
--build=[NAME]     to display stats for a single build.  
                   Ex: php lineageos_stats.php -blavender  
                   Ex: php lineageos_stats.php --build=lavender  
                   Ex: php lineageos_stats.php -b"Xiaomi Redmi Note 7"
                   Ex: php lineageos_stats.php --build="nOtE 7"  
                   The search is case insensitive and can find partial 
                   strings.
                   
-s[SEP]            The field separator for tables, which can be any 
--separator=[SEP]  string and is " | " by default. Set a different 
                   separator to not have data truncated. It is 
                   recommended to set to "\t" (tab) if copying into a 
                   spreadsheet and to ',' (comma) or ';' (semicolon) if
                   copying into a CSV (comma separated value) file. 
                   Ex: php lineageos_stats.php -s"\t"                 
                   Ex: php lineageos_stats.php -separator="; "      
                   
-f                 Find new builds by downloading all the countries and
--find-builds      looking for new builds and add them to the 
                   buildsList.txt file.                     
                  
-u                 Update the list of builds in the buildsList.txt
--update-builds    file from the official builds on the LineageOS wiki.
                   This option downloads roughly 550 files.  
                                                                      
-p                 Update the population of the countries to the current
--update-pop       year, which is stored in the countriesList.txt file.
                   This option involves roughly 220 downloads.   
                                                                       
-S[VER]            Set the oldest supported LineageOS version that is    
--supported=[VER]  getting security updates, which is 20 by default 
                   (Android/AOSP 13). This number needs to be updated
                   over time as Google ends security updates.
                   Ex: php lineageos_stats.php -S21
                   Ex: php lineageos_stats.php --supported=21
                  
-v , --verbose     Show information about what countries are being  
                   downloaded and what builds were found. Recommended 
                   for progress on how script is progressing when 
                   getting the build list.  
```

**Author:**  Amos Batto (amosbatto[AT]yahoo.com, https://amosbbatto.wordpress.com)  
**License:** MIT license (for the lineageos_stats script and the included 
         SimpleHtmlDom https://sourceforge.net/projects/simplehtmldom)  
**Last update:**    2025-11-15 (version 0.5)  

----------------

For people who don't what to install and run this script on their own
computers, here is the output of the script:

```
$ php lineageos_stats.php  

Countries by number of LineageOS installs
---------------------------------------------------------------------------------------------
| Rank |   CC    |        Country         | Installs | % Installs | Installs/M | Pop. (000) |
---------------------------------------------------------------------------------------------
| 1    | BR      | Brazil                 |  1931887 |     45.34% |       8830 |  218792.34 |
| 2    | CN      | China                  |  1261650 |     29.61% |        886 | 1424390.16 |
| 3    | US      | United States          |   306231 |      7.19% |        891 |  343578.37 |
| 4    | Unknown |                        |   198995 |      4.67% |            |            |
| 5    | VN      | Vietnam                |    81259 |      1.91% |        812 |  100098.11 |
| 6    | ID      | Indonesia              |    44109 |      1.04% |        156 |  281983.28 |
| 7    | DE      | Germany                |    42974 |      1.01% |        517 |   83198.28 |
| 8    | UA      | Ukraine                |    35387 |      0.83% |        913 |   38752.76 |
| 9    | RU      | Russian Federation     |    33035 |      0.78% |        230 |  143498.10 |
| 10   | IN      | India                  |    25648 |      0.60% |         18 | 1454478.87 |
| 11   | KR      | South Korea            |    24420 |      0.57% |        472 |   51690.17 |
| 12   | FR      | France                 |    19532 |      0.46% |        300 |   64999.81 |
| 13   | GB      | United Kingdom         |    14421 |      0.34% |        212 |   68176.94 |
| 14   | ES      | Spain                  |    12797 |      0.30% |        270 |   47419.65 |
| 15   | IT      | Italy                  |    12456 |      0.29% |        213 |   58519.30 |
| 16   | TR      | Turkey                 |    11119 |      0.26% |        128 |   86692.40 |
| 17   | TH      | Thailand               |    10954 |      0.26% |        152 |   71948.72 |
| 18   | PL      | Poland                 |    10751 |      0.25% |        271 |   39621.54 |
| 19   | EG      | Egypt                  |    10132 |      0.24% |         87 |  116258.11 |
| 20   | KG      | Kyrgyzstan             |     8871 |      0.21% |       1278 |    6941.72 |
| 21   | KH      | Cambodia               |     8661 |      0.20% |        501 |   17291.94 |
| 22   | JP      | Japan                  |     8169 |      0.19% |         67 |  121956.35 |
| 23   | MX      | Mexico                 |     7579 |      0.18% |         58 |  130292.20 |
| 24   | NL      | Netherlands            |     6895 |      0.16% |        389 |   17721.71 |
| 25   | CA      | Canada                 |     6718 |      0.16% |        170 |   39427.32 |
| 26   | BD      | Bangladesh             |     4695 |      0.11% |         27 |  176405.11 |
| 27   | IR      | Iran                   |     4339 |      0.10% |         48 |   90405.43 |
| 28   | IQ      | Iraq                   |     4275 |      0.10% |         90 |   47539.33 |
| 29   | AR      | Argentina              |     4240 |      0.10% |         92 |   46333.56 |
| 30   | PK      | Pakistan               |     3791 |      0.09% |         15 |  249900.67 |
| 31   | TW      | Taiwan                 |     3680 |      0.09% |        159 |   23112.79 |
| 32   | PH      | Philippines            |     3621 |      0.08% |         30 |  120847.21 |
| 33   | CO      | Colombia               |     3201 |      0.08% |         61 |   52608.11 |
| 34   | MA      | Morocco                |     3113 |      0.07% |         81 |   38567.99 |
| 35   | AU      | Australia              |     3081 |      0.07% |        114 |   26955.11 |
| 36   | MY      | Malaysia               |     2934 |      0.07% |         84 |   35024.61 |
| 37   | CZ      | Czech Republic         |     2767 |      0.06% |        263 |   10509.90 |
| 38   | DZ      | Algeria                |     2746 |      0.06% |         59 |   46916.39 |
| 39   | AT      | Austria                |     2716 |      0.06% |        302 |    8993.88 |
| 40   | RO      | Romania                |     2697 |      0.06% |        139 |   19426.02 |
| 41   | PT      | Portugal               |     2645 |      0.06% |        259 |   10198.22 |
| 42   | LA      | Laos                   |     2384 |      0.06% |        304 |    7837.33 |
| 43   | CH      | Switzerland            |     2372 |      0.06% |        266 |    8904.03 |
| 44   | SE      | Sweden                 |     2320 |      0.05% |        216 |   10733.17 |
| 45   | HU      | Hungary                |     2261 |      0.05% |        229 |    9871.85 |
| 46   | SY      | Syria                  |     2215 |      0.05% |         87 |   25416.53 |
| 47   | BY      | Belarus                |     2200 |      0.05% |        234 |    9412.89 |
| 48   | NG      | Nigeria                |     2010 |      0.05% |          9 |  234515.28 |
| 49   | PE      | Peru                   |     1920 |      0.05% |         55 |   35012.63 |
| 50   | BE      | Belgium                |     1880 |      0.04% |        160 |   11744.10 |
| 51   | CL      | Chile                  |     1800 |      0.04% |         91 |   19689.60 |
| 52   | GR      | Greece                 |     1795 |      0.04% |        175 |   10263.52 |
| 53   | FI      | Finland                |     1778 |      0.04% |        320 |    5553.89 |
| 54   | AE      | United Arab Emirates   |     1704 |      0.04% |        176 |    9664.64 |
| 55   | HK      | Hong Kong              |     1685 |      0.04% |        225 |    7499.22 |
| 56   | SA      | Saudi Arabia           |     1463 |      0.03% |         39 |   37985.18 |
| 57   | IL      | Israel                 |     1370 |      0.03% |        145 |    9447.25 |
| 58   | VE      | Venezuela              |     1325 |      0.03% |         44 |   29921.20 |
| 59   | GH      | Ghana                  |     1257 |      0.03% |         35 |   35433.23 |
| 60   | KZ      | Kazakhstan             |     1240 |      0.03% |         62 |   20053.76 |
| 61   | RS      | Serbia                 |     1220 |      0.03% |        173 |    7056.76 |
| 62   | SK      | Slovakia               |     1187 |      0.03% |        211 |    5635.58 |
| 63   | BG      | Bulgaria               |     1177 |      0.03% |        179 |    6565.71 |
| 64   | ZA      | South Africa           |     1143 |      0.03% |         19 |   61666.72 |
| 65   | OM      | Oman                   |     1126 |      0.03% |        236 |    4780.10 |
| 66   | MM      | Myanmar                |     1078 |      0.03% |         19 |   55333.30 |
| 67   | EC      | Ecuador                |     1065 |      0.02% |         57 |   18561.53 |
| 68   | MG      | Madagascar             |      997 |      0.02% |         31 |   31789.88 |
| 69   | BO      | Bolivia                |      976 |      0.02% |         77 |   12744.38 |
| 70   | NP      | Nepal                  |      973 |      0.02% |         31 |   31574.21 |
| 71   | LK      | Sri Lanka              |      952 |      0.02% |         43 |   21999.75 |
| 72   | NZ      | New Zealand            |      949 |      0.02% |        179 |    5310.18 |
| 73   | KE      | Kenya                  |      928 |      0.02% |         16 |   57312.36 |
| 74   | CM      | Cameroon               |      919 |      0.02% |         30 |   30143.01 |
| 75   | SV      | El Salvador            |      905 |      0.02% |        141 |    6425.92 |
| 76   | LT      | Lithuania              |      879 |      0.02% |        329 |    2668.64 |
| 77   | DK      | Denmark                |      871 |      0.02% |        146 |    5968.10 |
| 78   | NO      | Norway                 |      852 |      0.02% |        153 |    5554.01 |
| 79   | UZ      | Uzbekistan             |      762 |      0.02% |         21 |   36154.81 |
| 80   | SG      | Singapore              |      743 |      0.02% |        122 |    6089.12 |
| 81   | AZ      | Azerbaijan             |      713 |      0.02% |         68 |   10509.13 |
| 82   | IE      | Ireland                |      679 |      0.02% |        133 |    5120.51 |
| 83   | JO      | Jordan                 |      676 |      0.02% |         59 |   11441.48 |
| 84   | BA      | Bosnia and Herzegovina |      646 |      0.02% |        203 |    3181.67 |
| 85   | HR      | Croatia                |      639 |      0.01% |        161 |    3964.59 |
| 86   | MD      | Moldova                |      550 |      0.01% |        169 |    3255.60 |
| 87   | DO      | Dominican Republic     |      544 |      0.01% |         47 |   11531.12 |
| 88   | ET      | Ethiopia               |      488 |      0.01% |          4 |  132906.56 |
| 89   | EE      | Estonia                |      470 |      0.01% |        357 |    1314.93 |
| 90   | SI      | Slovenia               |      458 |      0.01% |        216 |    2117.76 |
| 91   | TN      | Tunisia                |      454 |      0.01% |         36 |   12664.91 |
| 92   | ZM      | Zambia                 |      447 |      0.01% |         21 |   21701.09 |
| 93   | TG      | Togo                   |      405 |     0.010% |         42 |    9721.61 |
| 94   | LV      | Latvia                 |      401 |     0.009% |        224 |    1790.95 |
| 95   | GE      | Georgia                |      388 |     0.009% |        105 |    3709.60 |
| 96   | ML      | Mali                   |      371 |     0.009% |         15 |   24750.68 |
| 97   | PY      | Paraguay               |      363 |     0.009% |         52 |    7030.51 |
| 98   | UG      | Uganda                 |      358 |     0.008% |          7 |   51271.05 |
| 99   | UY      | Uruguay                |      329 |     0.008% |         96 |    3423.13 |
| 100  | YE      | Yemen                  |      328 |     0.008% |          9 |   35992.72 |
| 101  | CU      | Cuba                   |      322 |     0.008% |         29 |   11152.68 |
| 102  | CI      | Côte d'Ivoire          |      311 |     0.007% |         10 |   30336.36 |
| 103  | SN      | Senegal                |      308 |     0.007% |         16 |   18683.12 |
| 104  | CR      | Costa Rica             |      287 |     0.007% |         54 |    5279.88 |
| 105  | GT      | Guatemala              |      272 |     0.006% |         15 |   18633.71 |
| 106  | AM      | Armenia                |      265 |     0.006% |         95 |    2777.03 |
| 107  | AO      | Angola                 |      229 |     0.005% |          6 |   38930.92 |
| 108  | BJ      | Benin                  |      228 |     0.005% |         16 |   14450.29 |
| 109  | AL      | Albania                |      217 |     0.005% |         77 |    2821.66 |
| 110  | CD      | Congo, Democratic Rep… |      214 |     0.005% |          2 |  109038.95 |
| 111  | HN      | Honduras               |      191 |     0.004% |         17 |   10922.38 |
| 112  | JM      | Jamaica                |      176 |     0.004% |         62 |    2823.22 |
| 113  | PA      | Panama                 |      174 |     0.004% |         38 |    4586.02 |
| 114  | TZ      | Tanzania               |      173 |     0.004% |          2 |   71407.49 |
| 114  | AF      | Afghanistan            |      173 |     0.004% |          4 |   44504.39 |
| 116  | QA      | Qatar                  |      167 |     0.004% |         61 |    2757.03 |
| 117  | MK      | Macedonia              |      163 |     0.004% |         78 |    2082.43 |
| 118  | LB      | Lebanon                |      162 |     0.004% |         32 |    5098.76 |
| 119  | CY      | Cyprus                 |      155 |     0.004% |        121 |    1276.43 |
| 120  | NI      | Nicaragua              |      152 |     0.004% |         21 |    7236.41 |
| 121  | BH      | Bahrain                |      144 |     0.003% |         95 |    1511.55 |
| 122  | RE      | Réunion                |      142 |     0.003% |        142 |     996.65 |
| 123  | KW      | Kuwait                 |      138 |     0.003% |         31 |    4386.76 |
| 124  | LY      | Libya                  |      137 |     0.003% |         19 |    7037.69 |
| 125  | ZW      | Zimbabwe               |      132 |     0.003% |          8 |   17371.73 |
| 126  | TJ      | Tajikistan             |      129 |     0.003% |         12 |   10515.17 |
| 127  | LU      | Luxembourg             |      125 |     0.003% |        187 |     668.03 |
| 128  | MZ      | Mozambique             |      124 |     0.003% |          3 |   35824.40 |
| 129  | GM      | Gambia                 |      119 |     0.003% |         41 |    2910.51 |
| 130  | MW      | Malawi                 |      104 |     0.002% |          5 |   22028.28 |
| 131  | TT      | Trinidad and Tobago    |       88 |     0.002% |         57 |    1540.90 |
| 132  | MT      | Malta                  |       85 |     0.002% |        158 |     538.26 |
| 133  | IS      | Iceland                |       82 |     0.002% |        216 |     379.99 |
| 134  | ME      | Montenegro             |       81 |     0.002% |        129 |     625.62 |
| 135  | BF      | Burkina Faso           |       77 |     0.002% |          3 |   24430.76 |
| 136  | SL      | Sierra Leone           |       76 |     0.002% |          8 |    9163.40 |
| 137  | MV      | Maldives               |       70 |     0.002% |        136 |     515.25 |
| 138  | MN      | Mongolia               |       69 |     0.002% |         20 |    3537.56 |
| 139  | PG      | Papua New Guinea       |       67 |     0.002% |          6 |   10699.30 |
| 140  | MU      | Mauritius              |       64 |     0.002% |         49 |    1303.19 |
| 141  | SD      | Sudan                  |       61 |     0.001% |          1 |   50602.05 |
| 142  | CG      | Congo                  |       60 |     0.001% |          9 |    6382.31 |
| 143  | RW      | Rwanda                 |       59 |     0.001% |          4 |   14734.02 |
| 144  | GN      | Guinea                 |       57 |     0.001% |          4 |   14869.44 |
| 145  | MC      | Monaco                 |       53 |     0.001% |       1382 |      38.34 |
| 146  | SB      | Solomon Islands        |       52 |     0.001% |         67 |     772.86 |
| 147  | MO      | Macao                  |       47 |     0.001% |         65 |     721.83 |
| 148  | BN      | Brunei                 |       45 |     0.001% |         98 |     459.01 |
| 149  | TM      | Turkmenistan           |       44 |     0.001% |          7 |    6676.25 |
| 150  | HT      | Haiti                  |       41 |    0.0010% |          3 |   12008.11 |
| 151  | NA      | Namibia                |       38 |    0.0009% |         14 |    2689.84 |
| 152  | GP      | Guadeloupe             |       37 |    0.0009% |         93 |     396.83 |
| 153  | BZ      | Belize                 |       36 |    0.0008% |         85 |     422.39 |
| 154  | ER      | Eritrea                |       35 |    0.0008% |          9 |    3888.89 |
| 155  | PR      | Puerto Rico            |       29 |    0.0007% |          9 |    3274.95 |
| 156  | SR      | Suriname               |       27 |    0.0006% |         43 |     634.16 |
| 157  | AD      | Andorra                |       26 |    0.0006% |        314 |      82.90 |
| 158  | NE      | Niger                  |       25 |    0.0006% |        0.9 |   29304.37 |
| 158  | GA      | Gabon                  |       25 |    0.0006% |         10 |    2532.40 |
| 160  | MR      | Mauritania             |       24 |    0.0006% |          5 |    5126.76 |
| 160  | BW      | Botswana               |       24 |    0.0006% |          9 |    2762.91 |
| 162  | SO      | Somalia                |       22 |    0.0005% |          1 |   19275.68 |
| 162  | LR      | Liberia                |       22 |    0.0005% |          4 |    5655.95 |
| 162  | KP      | North Korea            |       22 |    0.0005% |        0.8 |   26319.28 |
| 162  | CV      | Cape Verde             |       22 |    0.0005% |         36 |     610.15 |
| 166  | BI      | Burundi                |       19 |    0.0004% |          1 |   13944.57 |
| 167  | XK      | Kosovo                 |       18 |    0.0004% |         11 |    1671.32 |
| 167  | FJ      | Fiji                   |       18 |    0.0004% |         19 |     949.92 |
| 169  | KM      | Comoros                |       17 |    0.0004% |         19 |     882.92 |
| 170  | GY      | Guyana                 |       16 |    0.0004% |         19 |     824.99 |
| 171  | TD      | Chad                   |       14 |    0.0003% |        0.7 |   19419.74 |
| 172  | NC      | New Caledonia          |       13 |    0.0003% |         44 |     298.84 |
| 172  | LI      | Liechtenstein          |       13 |    0.0003% |        324 |      40.13 |
| 172  | CW      | Curaçao                |       13 |    0.0003% |         67 |     193.82 |
| 175  | VA      | Vatican City           |       11 |    0.0003% |      22000 |       0.50 |
| 176  | PF      | French Polynesia       |       10 |    0.0002% |         32 |     313.78 |
| 176  | GW      | Guinea-Bissau          |       10 |    0.0002% |          4 |    2243.88 |
| 178  | DJ      | Djibouti               |        7 |    0.0002% |          6 |    1168.10 |
| 178  | BT      | Bhutan                 |        7 |    0.0002% |          9 |     797.29 |
| 178  | BB      | Barbados               |        7 |    0.0002% |         25 |     282.58 |
| 181  | VC      | Saint Vincent and the… |        6 |    0.0001% |         58 |     103.82 |
| 181  | TL      | Timor-Leste            |        6 |    0.0001% |          4 |    1398.99 |
| 181  | GL      | Greenland              |        6 |    0.0001% |        108 |      55.75 |
| 181  | FO      | Faroe Islands          |        6 |    0.0001% |        107 |      56.00 |
| 181  | BS      | Bahamas                |        6 |    0.0001% |         14 |     417.76 |
| 186  | ST      | Sao Tome and Principe  |        5 |    0.0001% |         21 |     240.93 |
| 186  | SC      | Seychelles             |        5 |    0.0001% |         46 |     108.83 |
| 186  | CF      | Central African Repub… |        5 |    0.0001% |        0.8 |    6095.40 |
| 186  | AW      | Aruba                  |        5 |    0.0001% |         47 |     106.04 |
| 190  | SZ      | Eswatini               |        4 |   0.00009% |          3 |    1234.73 |
| 190  | GU      | Guam                   |        4 |   0.00009% |         23 |     175.24 |
| 192  | NN      | Sint Maarten (Dutch p… |        3 |   0.00007% |         68 |      43.92 |
| 192  | LC      | Saint Lucia            |        3 |   0.00007% |         17 |     181.31 |
| 192  | GQ      | Equatorial Guinea      |        3 |   0.00007% |          2 |    1795.16 |
| 192  | GI      | Gibraltar              |        3 |   0.00007% |         75 |      40.13 |
| 192  | EH      | Western Sahara         |        3 |   0.00007% |          5 |     609.28 |
| 192  | EA      | Ceuta and Melilla      |        3 |   0.00007% |         18 |     169.16 |
| 192  | DM      | Dominica               |        3 |   0.00007% |         46 |      65.87 |
| 192  | AS      | American Samoa         |        3 |   0.00007% |         65 |      46.03 |
| 192  | AI      | Anguilla               |        3 |   0.00007% |        204 |      14.73 |
| 201  | SS      | South Sudan            |        2 |   0.00005% |        0.2 |   11471.29 |
| 201  | SM      | San Marino             |        2 |   0.00005% |         60 |      33.57 |
| 201  | PS      | Palestine              |        2 |   0.00005% |        0.4 |    5619.37 |
| 201  | LS      | Lesotho                |        2 |   0.00005% |        0.8 |    2381.11 |
| 201  | KY      | Cayman Islands         |        2 |   0.00005% |         26 |      75.84 |
| 206  | WS      | Samoa                  |        1 |   0.00002% |          4 |     232.20 |
| 206  | TO      | Tonga                  |        1 |   0.00002% |          9 |     109.58 |
| 206  | NF      | Norfolk Island         |        1 |   0.00002% |            |            |
| 206  | KI      | Kiribati               |        1 |   0.00002% |          7 |     137.96 |
| 206  | IO      | British Indian Ocean … |        1 |   0.00002% |         25 |      39.73 |
| 206  | GD      | Grenada                |        1 |   0.00002% |          8 |     127.55 |
| 206  | FK      | Falkland Islands       |        1 |   0.00002% |        288 |       3.47 |
| 206  | AG      | Antigua and Barbuda    |        1 |   0.00002% |         10 |      95.31 |
|      | World   | World                  |  4261200 |       100% |        520 | 8191217.93 |
---------------------------------------------------------------------------------------------

Downloading builds from http://stats.lineageos.org. Press 'b' to break downloads.

LineageOS builds by number of installs
---------------------------------------------------------------------------------------------------------------------------------------------
| Rank |      Build       |     Maker      |           Model           |     Processor      | Mod.Released | Status | Installs | % Installs |
---------------------------------------------------------------------------------------------------------------------------------------------
| 1    | channel          | Motorola       | moto g7 play              | Snapdragon 632     | 2019-03-01   | O      |   363409 |      8.52% |
| 2    | dipper           | Xiaomi         | Mi 8                      | Snapdragon 845     | 2018-07-01   | O      |   326556 |      7.66% |
| 3    | ocean            | Motorola       | moto g7 power             | Snapdragon 632     | 2019-02-01   | O      |   176848 |      4.15% |
| 4    | lake             | Motorola       | moto g7 plus              | Snapdragon 636     | 2019-02-01   | O      |   173709 |      4.07% |
| 5    | beyond0lte       | Samsung        | Galaxy S10e               | Exynos 9820        | 2019-03-08   | O      |   173359 |      4.07% |
| 6    | jeter            | Motorola       | moto g6 play              | Snapdragon 430     | 2018-05-01   | U      |   169954 |      3.99% |
| 7    | beyond1lte       | Samsung        | Galaxy S10                | Exynos 9820        | 2019-03-08   | O      |   164294 |      3.85% |
| 8    | waydroid_x86_64  | virtual        | Waydroid on x86_64        | x86                | 2021-07-01   | U      |   150376 |      3.53% |
| 9    | sanders          | Motorola       | Moto G5S Plus             | Snapdragon 625     | 2017-08-01   | U      |   125282 |      2.94% |
| 10   | beyond2lte       | Samsung        | Galaxy S10+               | Exynos 9825        | 2019-08-23   | O      |   124753 |      2.93% |
| 11   | OP4AA7           | OPPO           | K5                        | Snapdragon 730G    | 2019-10-01   | U      |   120069 |      2.82% |
| 12   | greatlte         | Samsung        | Galaxy Note 8             | Exynos 8895        | 2017-09-01   | U      |   109260 |      2.56% |
| 13   | hero2lte         | Samsung        | Galaxy S7 Edge            | Exynos 8890        | 2016-03-18   | D      |   105210 |      2.47% |
| 14   | herolte          | Samsung        | Galaxy S7                 | Exynos 8890        | 2016-03-18   | D      |    87411 |      2.05% |
| 15   | sagit            | Xiaomi         | Mi 6                      | Snapdragon 835     | 2017-04-01   | O      |    81704 |      1.92% |
| 16   | a71              | Samsung        | Galaxy A71                | Snapdragon 730     | 2020-01-17   | O      |    79668 |      1.87% |
| 17   | ugg              | Xiaomi         | Redmi Note 5A Prime, Red… | Snapdragon 435     | 2017-11-01   | U      |    61108 |      1.43% |
| 18   | A57              | OPPO           | A57 (2016)                | Snapdragon 435     | 2016-12-01   | U      |    61059 |      1.43% |
| 19   | HWPAR            | Huawei         | Nova 3                    | Kirin 970          | 2018-08-01   | U      |    60064 |      1.41% |
| 20   | R9               | OPPO           | R9                        | Helio P10          | 2016-03-01   | U      |    60018 |      1.41% |
| 21   | RMX2201CN        | Realme         | V3 5G                     | Dimensity 720      | 2020-09-10   | U      |    59967 |      1.41% |
| 22   | HWSEA-A          | Huawei         | Nova 5 Pro                | Kirin 980          | 2019-06-01   | U      |    59924 |      1.41% |
| 23   | HWMAR            | Huawei         | P30 Lite                  | Kirin 710          | 2019-04-25   | U      |    59868 |      1.40% |
| 24   | PACM00           | OPPO           | R15 10                    | Helio P60          | 2018-04-01   | U      |    59699 |      1.40% |
| 25   | prada            | LG             | Prada 3.0                 | OMAP 4430          | 2012-01-01   | U      |    59695 |      1.40% |
| 26   | HWDUB-Q          | Huawei         | Y7 Prime 2019             | Snapdragon 450     | 2019-01-01   | U      |    59558 |      1.40% |
| 27   | PBDM00           | OPPO           | R17 Pro / RX17 Pro        | Snapdragon 710     | 2018-11-01   | U      |    59080 |      1.39% |
| 28   | troika           | Motorola       | one action                | Exynos 9609        | 2019-10-31   | O      |    44206 |      1.04% |
| 29   | miatoll          | Xiaomi         | POCO M2 Pro, Redmi Note … | Snapdragon 720G    | 2020-03-17   | O      |    31448 |      0.74% |
| 30   | kane             | Motorola       | one vision, p50           | Exynos 9609        | 2019-05-15   | O      |    27407 |      0.64% |
| 31   | j8y18lte         | Samsung        | J8 (2018)                 | Snapdragon 450     | 2018-07-01   | U      |    27033 |      0.63% |
| 32   | river            | Motorola       | moto g7                   | Snapdragon 632     | 2019-02-01   | O      |    24731 |      0.58% |
| 33   | a20              | Samsung        | Galaxy A20                | Exynos 7884        | 2019-04-05   | U      |    24042 |      0.56% |
| 34   | nx_tab           | Nintendo       | Switch v1 [Tablet], Swit… | Tegra X1 (T210)    | 2017-03-03   | O      |    21966 |      0.52% |
| 35   | zerofltexx       | Samsung        | Galaxy S6                 | Exynos 7420        | 2015-04-01   | D      |    20999 |      0.49% |
| 36   | waydroid_arm64   | virtual        | Waydroid on ARM64         | ARM                | 2021-07-01   | U      |    19890 |      0.47% |
| 37   | tiffany          | Xiaomi         | Mi 5X                     | Snapdragon 625     | 2017-09-01   | U      |    16889 |      0.40% |
| 38   | apollon          | Xiaomi         | Mi 10T, Mi 10T Pro, Redm… | Snapdragon 865     | 2020-10-01   | O      |    16094 |      0.38% |
| 39   | karnak           | Amazon         | Fire HD 8                 | MediaTek MT8163    | 2018-10-04   | U      |    15056 |      0.35% |
| 40   | matissewifi      | Samsung        | Galaxy Tab 4 10.1 Wi-Fi   | Snapdragon 400     | 2014-06-01   | U      |    13942 |      0.33% |
| 41   | a70q             | Samsung        | Galaxy A70 (SM-A705)      | Snapdragon 675     | 2019-05-01   | U      |    13026 |      0.31% |
| 42   | lavender         | Xiaomi         | Redmi Note 7              | Snapdragon 660     | 2019-01-01   | D      |    12366 |      0.29% |
| 43   | tissot           | Xiaomi         | Mi A1                     | Snapdragon 625     | 2017-10-01   | D      |    12128 |      0.28% |
| 44   | dumpling         | OnePlus        | OnePlus 5T                | Snapdragon 835     | 2017-11-01   | O      |     9847 |      0.23% |
| 45   | j6primelte       | Samsung        | Galaxy J6+                | Snapdragon 425     | 2018-09-25   | U      |     9795 |      0.23% |
| 46   | n8000            | Samsung        | Galaxy Note 10.1          | Exynos 4 Quad 4412 | 2012-08-01   | U      |     9714 |      0.23% |
| 47   | p10              | Huawei         | P10                       | Kirin 960          | 2017-03-01   | U      |     8812 |      0.21% |
| 48   | on7xelte         | Samsung        | Galaxy J7 Prime           | Exynos 7870        | 2016-09-01   | U      |     8616 |      0.20% |
| 49   | rpi4             | Raspberry Pi   | Raspberry Pi 4            | Broadcom BCM2711   | 2019-06-24   | U      |     8147 |      0.19% |
| 50   | Mi439            | Xiaomi         | Redmi 7A, Redmi 8, Redmi… | Snapdragon 439     | 2019-05-28   | O      |     8007 |      0.19% |
| 51   | a30              | Samsung        | Galaxy A30                | Exynos 7904        | 2019-03-01   | U      |     7475 |      0.18% |
| 52   | gemini           | Xiaomi         | Mi 5                      | Snapdragon 820     | 2016-04-01   | O      |     7391 |      0.17% |
| 53   | n8010            | Samsung        | Galaxy Note 10.1 (N8010)  | Exynos 4 Quad 4412 | 2012-08-01   | U      |     7173 |      0.17% |
| 54   | whyred           | Xiaomi         | Redmi Note 5 Pro          | Snapdragon 636     | 2018-02-01   | D      |     6714 |      0.16% |
| 55   | gtel3g           | Samsung        | Galaxy Tab E              | Spreadtrum SC7730S | 2015-07-01   | U      |     6617 |      0.16% |
| 56   | gtaxlwifi        | Samsung        | Galaxy Tab A 10.1" (2016) | Exynos 7870 Octa   | 2016-05-01   | U      |     6440 |      0.15% |
| 57   | mustang          | Amazon         | Fire 7 (2019)             | Mediatek MT8163    | 2019-06-06   | U      |     6387 |      0.15% |
| 58   | sweet            | Xiaomi         | Redmi Note 10 Pro, Redmi… | Snapdragon 732G    | 2021-03-01   | O      |     6361 |      0.15% |
| 59   | j4primelte       | Samsung        | Galaxy J4+                | Snapdragon 425     | 2018-10-01   | U      |     6247 |      0.15% |
| 60   | crownlte         | Samsung        | Galaxy Note 9             | Exynos 9810        | 2018-08-09   | D      |     6196 |      0.15% |
| 61   | douglas          | Amazon         | Fire HD 8 (2017)          | MediaTek MT8163    | 2017-06-01   | U      |     6063 |      0.14% |
| 62   | ford             | Amazon         | Fire 7" (ford)            | MediaTek MT8127    | 2015-11-01   | U      |     5733 |      0.13% |
| 63   | starlte          | Samsung        | Galaxy S9                 | Exynos 9810        | 2018-03-11   | D      |     5693 |      0.13% |
| 64   | TB8703           | Lenovo         | TAB 3 8 Plus              | Snapdragon 625     | 2017-03-01   | U      |     5582 |      0.13% |
| 65   | ginkgo           | Xiaomi         | Redmi Note 8, Redmi Note… | Snapdragon 665     | 2019-08-01   | O      |     5567 |      0.13% |
| 66   | espresso3g       | Samsung        | Galaxy Tab 2 7.0 (GSM), … | OMAP 4430          | 2012-04-01   | D      |     5314 |      0.12% |
| 67   | star2lte         | Samsung        | Galaxy S9+                | Exynos 9810        | 2018-03-11   | D      |     5247 |      0.12% |
| 68   | santos10wifi     | Samsung        | Galaxy Tab III 10.1       | Atom Z2560         | 2013-07-07   | U      |     5141 |      0.12% |
| 69   | beryllium        | Xiaomi         | POCO F1                   | Snapdragon 845     | 2018-08-01   | O      |     5099 |      0.12% |
| 70   | alioth           | Xiaomi         | POCO F3, Redmi K40, Mi 1… | Snapdragon 870     | 2021-02-01   | O      |     4994 |      0.12% |
| 71   | enchilada        | OnePlus        | OnePlus 6                 | Snapdragon 845     | 2018-04-01   | O      |     4943 |      0.12% |
| 72   | rpi5             | Raspberry Pi   | Raspberry Pi 5            | Broadcom BCM2712   | 2023-10-23   | U      |     4924 |      0.12% |
| 73   | Mi8937           | Xiaomi         | Redmi 3S, Redmi 3X, Redm… | Snapdragon 430     | 2016-06-14   | O      |     4872 |      0.11% |
| 74   | fajita           | OnePlus        | OnePlus 6T, OnePlus 6T (… | Snapdragon 845     | 2018-11-01   | O      |     4868 |      0.11% |
| 75   | core33g          | Samsung        | Galaxy Core Prime (SM-G3… | Snapdragon 410     | 2014-11-01   | U      |     4777 |      0.11% |
| 76   | m20lte           | Samsung        | Galaxy M20                | Exynos 7904        | 2019-01-28   | D      |     4757 |      0.11% |
| 77   | n1awifi          | Samsung        | Galaxy Note 10.1 Wi-Fi (… | Exynos 5420        | 2013-10-10   | D      |     4583 |      0.11% |
| 78   | klte             | Samsung        | Galaxy S5 LTE (G900F/M/R… | Snapdragon 801     | 2014-04-11   | D      |     4569 |      0.11% |
| 79   | a5y17lte         | Samsung        | Galaxy A5 (2017)          | Exynos 7880        | 2017-01-02   | D      |     4482 |      0.11% |
| 80   | clover           | Xiaomi         | Xiaomi Mi Pad 4           | Snapdragon 660     | 2018-06-25   | U      |     4425 |      0.10% |
| 81   | r8q              | Samsung        | Galaxy S20 FE, Galaxy S2… | Snapdragon 865     | 2020-10-02   | O      |     4406 |      0.10% |
| 82   | cheeseburger     | OnePlus        | OnePlus 5                 | Snapdragon 835     | 2017-06-01   | O      |     4398 |      0.10% |
| 83   | j7elte           | Samsung        | Galaxy J7 (2015)          | Exynos 7580        | 2015-06-01   | D      |     4301 |      0.10% |
| 84   | mido             | Xiaomi         | Redmi Note 4              | Snapdragon 625     | 2017-01-01   | D      |     4238 |      0.10% |
| 85   | coral            | Google         | Pixel 4 XL                | Snapdragon 855     | 2019-09-01   | O      |     4182 |      0.10% |
| 86   | blueline         | Google         | Pixel 3                   | Snapdragon 845     | 2018-10-01   | O      |     4057 |      0.10% |
| 87   | sunfish          | Google         | Pixel 4a                  | Snapdragon 730G    | 2020-08-01   | O      |     3897 |      0.09% |
| 88   | blossom          | Xiaomi         | Redmi 9A, Redmi 9C, Redm… | Helio G25 / G35    | 2020-07-07   | U      |     3717 |      0.09% |
| 89   | hlte             | Samsung        | Galaxy Note 3 LTE (N9005… | Snapdragon 800     | 2013-09-01   | D      |     3709 |      0.09% |
| 90   | nx563j           | Nubia          | Z17                       | Snapdragon 835     | 2017-06-01   | O      |     3549 |      0.08% |
| 91   | rosemary         | Xiaomi         | Redmi Note 10S, Redmi No… | Helio G95          | 2021-04-01   | O      |     3537 |      0.08% |
| 92   | laurel_sprout    | Xiaomi         | Mi A3                     | Snapdragon 665     | 2019-07-01   | O      |     3525 |      0.08% |
| 93   | harpia           | Motorola       | moto g4 play              | Snapdragon 410     | 2016-05-01   | D      |     3510 |      0.08% |
| 94   | chiron           | Xiaomi         | Mi MIX 2                  | Snapdragon 835     | 2017-09-01   | O      |     3476 |      0.08% |
| 95   | instantnoodlep   | OnePlus        | OnePlus 8 Pro             | Snapdragon 865     | 2020-04-01   | O      |     3446 |      0.08% |
| 96   | wayne            | Xiaomi         | Mi 6X                     | Snapdragon 660     | 2018-04-01   | D      |     3445 |      0.08% |
| 97   | gtexslte         | Samsung        | Galaxy Tab A 7.0 LTE (20… | Snapdragon 410     | 2016-03-01   | U      |     3329 |      0.08% |
| 98   | sargo            | Google         | Pixel 3a                  | Snapdragon 670     | 2019-04-01   | O      |     3298 |      0.08% |
| 99   | flo              | Google         | Nexus 7 (Wi-Fi, 2013 ver… | Snapdragon S4 Pro  | 2013-07-26   | D      |     3231 |      0.08% |
| 100  | austin           | Amazon         | Fire 7" (Austin)          | MediaTek MT8127    | 2017-06-01   | U      |     3181 |      0.07% |
| 101  | mocha            | Xiaomi         | Mi Pad 1                  | Tegra K1 (T124)    | 2014-06-01   | U      |     3159 |      0.07% |
| 102  | vayu             | Xiaomi         | POCO X3 Pro               | Snapdragon 860     | 2021-03-01   | O      |     3108 |      0.07% |
| 103  | guacamole        | OnePlus        | OnePlus 7 Pro, OnePlus 7… | Snapdragon 855     | 2019-05-01   | O      |     3064 |      0.07% |
| 104  | espressowifi     | Samsung        | Galaxy Tab 2 7.0 (Wi-Fi … | OMAP 4430          | 2012-05-01   | D      |     3015 |      0.07% |
| 105  | redfin           | Google         | Pixel 5                   | Snapdragon 765G 5G | 2020-10-01   | O      |     2975 |      0.07% |
| 106  | surya            | Xiaomi         | POCO X3 NFC               | Snapdragon 732G    | 2020-09-08   | O      |     2951 |      0.07% |
| 107  | gta4xlwifi       | Samsung        | Galaxy Tab S6 Lite (Wi-F… | Exynos 9611        | 2020-04-02   | O      |     2887 |      0.07% |
| 108  | kebab            | OnePlus        | OnePlus 8T, OnePlus 8T (… | Snapdragon 865     | 2020-10-01   | O      |     2876 |      0.07% |
| 109  | gtaxllte         | Samsung        | Galaxy Tab A (SM-T580)    | Exynos 7870 Octa   | 2016-05-01   | U      |     2829 |      0.07% |
| 110  | lmi              | Xiaomi         | POCO F2 Pro, Redmi K30 P… | Snapdragon 865     | 2020-03-01   | O      |     2797 |      0.07% |
| 111  | evert            | Motorola       | moto g6 plus              | Snapdragon 630     | 2018-05-01   | O      |     2774 |      0.07% |
| 112  | santos103g       | Samsung        | Galaxy Tab III 10.1       | Atom Z2560         | 2013-07-07   | U      |     2770 |      0.06% |
| 113  | onclite          | Xiaomi         | Redmi 7, Redmi Y3         | Snapdragon 632     | 2019-03-01   | D      |     2740 |      0.06% |
| 114  | montana          | Motorola       | moto g5s                  | Snapdragon 430     | 2017-08-01   | D      |     2713 |      0.06% |
| 115  | R11              | OPPO           | R11                       | Snapdragon 660     | 2017-06-01   | U      |     2705 |      0.06% |
| 116  | chagalllte       | Samsung        | Galaxy Tab S 10.5 LTE     | Exynos 5420        | 2014-07-01   | D      |     2670 |      0.06% |
| 117  | viennalte        | Samsung        | Galaxy Note Pro 12.2      | Exynos 5420 Octa   | 2014-02-13   | U      |     2658 |      0.06% |
| 118  | chagallwifi      | Samsung        | Galaxy Tab S 10.5 Wi-Fi … | Exynos 5420        | 2014-07-01   | D      |     2656 |      0.06% |
| 119  | merlinx          | Xiaomi         | Redmi Note 9              | Helio G85          | 2020-05-01   | D      |     2618 |      0.06% |
| 120  | A37              | OPPO           | A37, A37f, A37fw          | Snapdragon 410     | 2016-06-01   | U      |     2606 |      0.06% |
| 121  | lemonadep        | OnePlus        | OnePlus 9 Pro, OnePlus 9… | Snapdragon 888     | 2021-03-01   | O      |     2596 |      0.06% |
| 122  | x86_64_tv        | virtual        | Android TV on x86_64      | x86                |              | U      |     2587 |      0.06% |
| 123  | n5100            | Samsung        | Galaxy Note 8.0 (GSM)     | Exynos 4412        | 2013-04-01   | D      |     2559 |      0.06% |
| 124  | x2               | LeEco          | Le Max2                   | Snapdragon 820     | 2016-04-01   | D      |     2546 |      0.06% |
| 125  | gts4lvwifi       | Samsung        | Galaxy Tab S5e (Wi-Fi)    | Snapdragon 670     | 2019-04-01   | O      |     2478 |      0.06% |
| 126  | lemonade         | OnePlus        | OnePlus 9, OnePlus 9 (T-… | Snapdragon 888     | 2021-03-01   | O      |     2475 |      0.06% |
| 127  | matisse3g        | Samsung        | Galaxy Tab 4 10.1 3G      | Snapdragon 400     | 2014-06-01   | U      |     2420 |      0.06% |
| 128  | davinci          | Xiaomi         | Mi 9T, Redmi K20 (China)… | Snapdragon 730     | 2019-06-01   | O      |     2401 |      0.06% |
| 129  | a10              | Samsung        | Galaxy A10                | Exynos 7884        | 2019-03-01   | U      |     2272 |      0.05% |
| 130  | oneplus3         | OnePlus        | OnePlus 3, OnePlus 3T     | Snapdragon 820     | 2016-06-01   | D      |     2233 |      0.05% |
| 131  | bacon            | OnePlus        | OnePlus One               | Snapdragon 801     | 2014-06-06   | D      |     2168 |      0.05% |
| 132  | i9300            | Samsung        | Galaxy S III (Internatio… | Exynos 4412        | 2012-05-29   | D      |     2160 |      0.05% |
| 133  | gtexswifi        | Samsung        | Galaxy Tab A 7.0          | Spreadtrum SC8830  | 2016-03-01   | U      |     2148 |      0.05% |
| 134  | garden           | Xiaomi         | Redmi 9A, Redmi 9C        | Helio G25          | 2020-07-07   | U      |     2136 |      0.05% |
| 135  | mondrianwifi     | Samsung        | Galaxy Tab Pro 8.4        | Snapdragon 800     | 2014-01-01   | D      |     2120 |      0.05% |
| 136  | j5xnlte          | Samsung        | Galaxy J5 (J510MN/GN/FN)  | Snapdragon 410     | 2016-04-01   | U      |     2004 |      0.05% |
| 137  | gts210vewifi     | Samsung        | Galaxy Tab S2 9.7 Wi-Fi … | Snapdragon 652     | 2016-08-01   | D      |     1995 |      0.05% |
| 138  | matisselte       | Samsung        | Galaxy Tab 4 10.1 LTE     | Snapdragon 400     | 2014-05-01   | U      |     1989 |      0.05% |
| 139  | taimen           | Google         | Pixel 2 XL                | Snapdragon 835     | 2017-10-01   | O      |     1987 |      0.05% |
| 140  | gta4lwifi        | Samsung        | Galaxy Tab A7 10.4 2020 … | Snapdragon 662     | 2020-09-01   | O      |     1977 |      0.05% |
| 141  | noblelte         | Samsung        | Galaxy Note 5             | Exynos 7420 Octa   | 2015-08-21   | U      |     1930 |      0.05% |
| 142  | cactus           | Xiaomi         | Redmi 6A                  | Helio A22          | 2018-06-15   | U      |     1911 |      0.04% |
| 143  | vince            | Xiaomi         | Redmi 5 Plus              | Snapdragon 625     | 2017-12-07   | U      |     1896 |      0.04% |
| 144  | serranoltexx     | Samsung        | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |     1858 |      0.04% |
| 145  | star2qltechn     | Samsung        | Galaxy S9+                | Snapdragon 845     | 2018-03-16   | U      |     1837 |      0.04% |
| 146  | lancelot         | Xiaomi         | Redmi 9                   | Helio G85          | 2020-06-01   | D      |     1792 |      0.04% |
| 147  | crosshatch       | Google         | Pixel 3 XL                | Snapdragon 845     | 2018-10-01   | O      |     1781 |      0.04% |
| 148  | lisa             | Xiaomi         | Xiaomi 11 Lite 5G NE, Xi… | Snapdragon 778G 5G | 2021-09-01   | O      |     1762 |      0.04% |
| 149  | polaris          | Xiaomi         | Mi MIX 2S                 | Snapdragon 845     | 2018-04-01   | O      |     1758 |      0.04% |
| 150  | hotdogb          | OnePlus        | OnePlus 7T, OnePlus 7T (… | Snapdragon 855+    | 2019-09-01   | O      |     1753 |      0.04% |
| 151  | walleye          | Google         | Pixel 2                   | Snapdragon 835     | 2017-10-01   | O      |     1747 |      0.04% |
| 152  | instantnoodle    | OnePlus        | OnePlus 8, OnePlus 8 (T-… | Snapdragon 865     | 2020-04-01   | O      |     1737 |      0.04% |
| 153  | a7y17lte         | Samsung        | Galaxy A7 (2017)          | Exynos 7880        | 2017-01-02   | D      |     1734 |      0.04% |
| 154  | treltexx         | Samsung        | Galaxy Note 4             | Exynos 5433 Octa   | 2014-10-01   | U      |     1708 |      0.04% |
| 155  | X00TD            | ASUS           | Zenfone Max Pro M1        | Snapdragon 636     | 2018-05-01   | D      |     1697 |      0.04% |
| 156  | renoir           | Xiaomi         | Mi 11 Lite 5G             | Snapdragon 780G 5G | 2021-03-01   | O      |     1664 |      0.04% |
| 157  | tulip            | ZTE            | Axon 7 Mini               | Snapdragon 617     | 2016-09-01   | D      |     1651 |      0.04% |
| 158  | a52sxq           | Samsung        | Galaxy A52s 5G            | Snapdragon 778G 5G | 2021-09-01   | O      |     1641 |      0.04% |
| 159  | n2awifi          | Samsung        | Galaxy Tab PRO 10.1       | Exynos 5420        | 2014-02-01   | D      |     1635 |      0.04% |
| 160  | avicii           | OnePlus        | OnePlus Nord              | Snapdragon 765G    | 2020-07-21   | D      |     1633 |      0.04% |
| 161  | android_x86_64   | virtual        | Android on x86_64         | x86                |              | U      |     1628 |      0.04% |
| 162  | y2s              | Samsung        | Galaxy S20+, Galaxy S20+… | Exynos 990         | 2020-03-06   | O      |     1587 |      0.04% |
| 163  | beyondx          | Samsung        | Galaxy S10 5G             | Exynos 9820        | 2019-03-08   | O      |     1573 |      0.04% |
| 164  | umi              | Xiaomi         | Mi 10                     | Snapdragon 865     | 2020-02-01   | O      |     1570 |      0.04% |
| 165  | a5xelte          | Samsung        | Galaxy A5 (2016)          | Exynos 7580        | 2015-12-01   | D      |     1564 |      0.04% |
| 166  | a6lte            | Samsung        | Galaxy A6 (Exynos7870)    | Exynos 7870        | 2018-05-01   | U      |     1561 |      0.04% |
| 167  | hammerhead       | Google         | Nexus 5                   | Snapdragon 800     | 2013-10-31   | D      |     1556 |      0.04% |
| 168  | a21s             | Samsung        | Galaxy A21s               | Exynos 850         | 2020-06-02   | O      |     1539 |      0.04% |
| 169  | potter           | Motorola       | Moto G5 Plus              | Snapdragon 625     | 2017-04-01   | U      |     1535 |      0.04% |
| 170  | flox             | Google         | Nexus 7 2013 (Wi-Fi, Rep… | Snapdragon S4 Pro  | 2013-07-26   | D      |     1534 |      0.04% |
| 171  | gta4l            | Samsung        | Galaxy Tab A7 10.4 2020 … | Snapdragon 662     | 2020-09-01   | O      |     1532 |      0.04% |
| 172  | bonito           | Google         | Pixel 3a XL               | Snapdragon 670     | 2019-04-01   | O      |     1488 |      0.03% |
| 173  | kenzo            | Xiaomi         | Redmi Note 3              | Snapdragon 650     | 2016-02-01   | D      |     1475 |      0.03% |
| 174  | starqltechn      | Samsung        | Galaxy S9                 | Snapdragon 845     | 2018-03-16   | U      |     1446 |      0.03% |
| 175  | marble           | Xiaomi         | POCO F5 (Global), POCO F… | Snapdragon 7+ Gen… | 2023-03-28   | O      |     1435 |      0.03% |
| 176  | a3xelte          | Samsung        | Galaxy A3 (2016)          | Exynos 7578        | 2015-12-01   | D      |     1427 |      0.03% |
| 177  | jfltexx          | Samsung        | Galaxy S4 (GT-I9505, SGH… | Snapdragon 600     | 2013-04-01   | D      |     1399 |      0.03% |
| 178  | bluejay          | Google         | Pixel 6a                  | Tensor GS101       | 2022-07-01   | O      |     1396 |      0.03% |
| 179  | waydroid_tv_x86… | virtual        |                           | X86_64             |              | U      |     1372 |      0.03% |
| 180  | suez             | Amazon         | Fire HD 10                | MediaTek MT8173    | 2017-06-01   | U      |     1367 |      0.03% |
| 181  | tokay            | Google         | Pixel 9                   | Tensor G4          | 2024-08-22   | O      |     1329 |      0.03% |
| 182  | deen             | Motorola       | One                       | Snapdragon 625     | 2020-07-02   | U      |     1321 |      0.03% |
| 183  | gts4lv           | Samsung        | Galaxy Tab S5e (LTE)      | Snapdragon 670     | 2019-04-01   | O      |     1318 |      0.03% |
| 184  | libra            | Xiaomi         | Mi 4c                     | Snapdragon 808     | 2015-09-01   | D      |     1307 |      0.03% |
| 185  | TBX704           | Lenovo         | Tab 4 10 Plus             | Snapdragon 625     | 2017-07-01   | U      |     1300 |      0.03% |
| 186  | ms013g           | Samsung        | Galaxy Grand 2 Duos       | Snapdragon 400     | 2013-11-25   | D      |     1295 |      0.03% |
| 187  | n7100            | Samsung        | Galaxy Note II            | Exynos 4412 Quad   | 2012-10-01   | U      |     1284 |      0.03% |
| 188  | certus           | Xiaomi         | Redmi 6 / 6A              | Helio A22          | 2018-06-01   | U      |     1280 |      0.03% |
| 189  | helium           | Xiaomi         | Mi Max                    | Snapdragon 652     | 2016-05-01   | U      |     1276 |      0.03% |
| 190  | gauguin          | Xiaomi         | Mi 10T Lite 5G, Mi 10i 5… | Snapdragon 750G 5G | 2020-10-01   | O      |     1272 |      0.03% |
| 191  | gt58wifi         | Samsung        | Tab A 2015 8.0 (SM-T350)  | Snapdragon 410     | 2015-05-01   | U      |     1267 |      0.03% |
| 192  | grus             | Xiaomi         | Mi 9 SE                   | Snapdragon 712     | 2019-02-01   | O      |     1266 |      0.03% |
| 193  | waydroid_x86     | virtual        | Waydroid on i386          | x86                | 2021-07-01   | U      |     1231 |      0.03% |
| 194  | D22AP            | virtual        | Android 12 (API 22)       |                    |              | U      |     1215 |      0.03% |
| 195  | pioneer          | Sony           | Xperia XA2                | Snapdragon 630     | 2018-02-01   | O      |     1211 |      0.03% |
| 196  | grandppltedx     | Samsung        | Galaxy J2 Prime / Grand … | MediaTek MT6737T   | 2016-11-01   | U      |     1198 |      0.03% |
| 197  | fogos            | Motorola       | moto g34 5G, moto g45 5G  | Snapdragon 695     | 2023-12-29   | O      |     1194 |      0.03% |
| 198  | r36s             | R36S           | R36S with Panel 4         | Rockchip RK3326    | 2025-05-31   | U      |     1184 |      0.03% |
| 199  | FP3              | Fairphone      | Fairphone 3, Fairphone 3+ | Snapdragon 632     | 2019-09-01   | O      |     1179 |      0.03% |
| 200  | a52q             | Samsung        | Galaxy A52 4G             | Snapdragon 720G    | 2021-03-26   | O      |     1178 |      0.03% |
| 201  | flame            | Google         | Pixel 4                   | Snapdragon 855     | 2019-09-01   | O      |     1175 |      0.03% |
| 202  | v1awifi          | Samsung        | Galaxy Note Pro 12.2 Wi-… | Exynos 5420        | 2014-02-01   | D      |     1162 |      0.03% |
| 203  | a7y18lte         | Samsung        | Galaxy A7 (2018)          | Exynos 7 Octa 7885 | 2018-10-01   | U      |     1135 |      0.03% |
| 204  | lilac            | Sony           | Xperia XZ1 Compact        | Snapdragon 835     | 2017-10-01   | U      |     1125 |      0.03% |
| 205  | xmsirius         | Xiaomi         | Mi 8 SE                   | Snapdragon 710     | 2018-06-01   | D      |     1120 |      0.03% |
| 206  | klimtwifi        | Samsung        | Galaxy Tab S 8.4 Wi-Fi    | Exynos 5420        | 2014-07-01   | D      |     1115 |      0.03% |
| 207  | oneplus2         | OnePlus        | OnePlus 2                 | Snapdragon 810     | 2015-08-28   | D      |     1114 |      0.03% |
| 208  | j5lte            | Samsung        | Galaxy J5 (2015)          | Snapdragon 410     | 2015-06-26   | U      |     1101 |      0.03% |
| 209  | violet           | Xiaomi         | Redmi Note 7 Pro          | Snapdragon 675     | 2019-03-13   | O      |     1096 |      0.03% |
| 210  | osborn           | Smartisan      | Nut Pro 2, U3 Pro         | Snapdragon 660     | 2017-11-09   | U      |     1083 |      0.03% |
| 211  | rpi3             | Raspberry Pi   | Raspberry Pi 3            | Broadcom BCM2837   | 2016-02-29   | U      |     1078 |      0.03% |
| 212  | checkers         | Amazon         | Echo Show 5               | MediaTek MT8163    | 2019-06-01   | U      |     1073 |      0.03% |
| 213  | daisy            | Xiaomi         | Mi A2 Lite                | Snapdragon 625     | 2018-07-01   | U      |     1063 |      0.02% |
| 214  | devon            | Motorola       | moto g32                  | Snapdragon 680 4G  | 2022-08-01   | O      |     1061 |      0.02% |
| 215  | nx               | Nintendo       | Switch v1 [Android TV], … | Tegra X1 (T210)    | 2017-03-03   | O      |     1060 |      0.02% |
| 215  | cedric           | Motorola       | moto g5                   | Snapdragon 430     | 2017-03-01   | D      |     1060 |      0.02% |
| 217  | FP4              | Fairphone      | Fairphone 4               | Snapdragon 750G    | 2021-10-01   | O      |     1046 |      0.02% |
| 218  | ysl              | Xiaomi         | Redmi S2, Redmi Y2        | Snapdragon 625     | 2018-05-01   | U      |     1035 |      0.02% |
| 219  | mata             | Essential      | PH-1                      | Snapdragon 835     | 2017-08-01   | O      |     1010 |      0.02% |
| 220  | guacamoleb       | OnePlus        | OnePlus 7                 | Snapdragon 855     | 2019-05-01   | O      |     1004 |      0.02% |
| 221  | lynx             | Google         | Pixel 7a                  | Tensor GS201       | 2023-05-10   | O      |      984 |      0.02% |
| 222  | d2s              | Samsung        | Galaxy Note10+            | Exynos 9825        | 2019-08-23   | O      |      981 |      0.02% |
| 223  | bangkk           | Motorola       | moto g84 5G               | Snapdragon 695     | 2023-09-08   | O      |      977 |      0.02% |
| 224  | merlin           | Motorola       | moto g3 turbo             | Snapdragon 615     | 2015-11-01   | D      |      974 |      0.02% |
| 225  | n5110            | Samsung        | Galaxy Note 8.0 (Wi-Fi)   | Exynos 4412        | 2013-04-01   | D      |      972 |      0.02% |
| 226  | panther          | Google         | Pixel 7                   | Tensor GS201       | 2022-10-13   | O      |      970 |      0.02% |
| 227  | gts3lwifi        | Samsung        | Galaxy Tab S3 WiFi        | Snapdragon 820     | 2017-03-24   | U      |      968 |      0.02% |
| 227  | armani           | Xiaomi         | Redmi 1S                  | Snapdragon 400     | 2014-05-01   | D      |      968 |      0.02% |
| 229  | n8013            | Samsung        | Galaxy Note 10.1 WiFi     | Exynos 4412        | 2012-08-01   | U      |      963 |      0.02% |
| 229  | Mi8917           | Xiaomi         | Redmi 4A, Redmi 5A, Redm… | Snapdragon 425     | 2016-11-04   | O      |      963 |      0.02% |
| 231  | fog              | Xiaomi         | Redmi 10C                 | Snapdragon 680 4G  | 2022-03-23   | U      |      957 |      0.02% |
| 232  | gt510wifi        | Samsung        | Tab A 2015 9.7 SM-T550    | Snapdragon 410     | 2015-05-01   | U      |      956 |      0.02% |
| 233  | bramble          | Google         | Pixel 4a 5G               | Snapdragon 765G    | 2020-10-01   | O      |      952 |      0.02% |
| 234  | hltekor          | Samsung        | Galaxy Note 3 LTE (N900K… | Snapdragon 800     | 2013-09-01   | D      |      949 |      0.02% |
| 235  | klimtlte         | Samsung        | Galaxy Tab S 10.5 LTE (S… | Exynos 5 Octa 5420 | 2014-07-01   | U      |      935 |      0.02% |
| 236  | xz2c             | Sony           | Xperia XZ2 Compact        | Snapdragon 845     | 2018-04-01   | O      |      929 |      0.02% |
| 237  | payton           | Motorola       | moto x4                   | Snapdragon 630     | 2017-10-01   | O      |      917 |      0.02% |
| 238  | Mi8937_4_19      | Xiaomi         | Redmi 4X                  | Snapdragon 435     | 2017-02-28   | U      |      915 |      0.02% |
| 239  | rhode            | Motorola       | moto g52                  | Snapdragon 680 4G  | 2022-04-01   | O      |      912 |      0.02% |
| 239  | peridot          | Xiaomi         | Poco F6, Redmi Turbo 3    | Snapdragon 8s Gen… | 2024-05-23   | U      |      912 |      0.02% |
| 241  | joan             | LG             | V30 (Unlocked), V30 (T-M… | Snapdragon 835     | 2017-08-01   | O      |      910 |      0.02% |
| 241  | hydrogen         | Xiaomi         | Mi Max                    | Snapdragon 650     | 2016-05-01   | D      |      910 |      0.02% |
| 243  | gtowifi          | Samsung        | Galaxy Tab A 8.0 (2019)   | Snapdragon 429     | 2019-07-01   | O      |      906 |      0.02% |
| 244  | lt01wifi         | Samsung        | Galaxy Tab 3 8.0 (SM-T31… | Exynos 4 Dual 4212 | 2013-07-01   | U      |      902 |      0.02% |
| 245  | gta4xlveu        | Samsung        | Galaxy Tab S6 Lite        | Snapdragon 732G o… | 2022-05-23   | U      |      898 |      0.02% |
| 246  | ha3g             | Samsung        | Galaxy Note 3 (Internati… | Exynos 5420        | 2013-09-01   | D      |      890 |      0.02% |
| 247  | oriole           | Google         | Pixel 6                   | Tensor GS101       | 2021-10-19   | O      |      876 |      0.02% |
| 248  | gts28vewifi      | Samsung        | Galaxy Tab S2 8.0 Wi-Fi … | Snapdragon 652     | 2015-09-01   | D      |      870 |      0.02% |
| 248  | gts210wifi       | Samsung        | Galaxy Tab S2 9.7 (Wi-Fi) | Exynos 5433        | 2015-09-01   | D      |      870 |      0.02% |
| 250  | gts210ltexx      | Samsung        | Galaxy Tab S2 9.7 (LTE)   | Exynos 5433        | 2015-09-01   | D      |      862 |      0.02% |
| 251  | larry            | OnePlus        | OnePlus Nord CE 3 Lite 5… | Snapdragon 695     | 2023-04-11   | O      |      851 |      0.02% |
| 252  | PL2              | Nokia          | Nokia 6.1 (2018)          | Snapdragon 630     | 2018-05-06   | O      |      845 |      0.02% |
| 253  | rosy             | Xiaomi         | Redmi 5                   | Snapdragon 450     | 2017-12-01   | U      |      844 |      0.02% |
| 254  | n8020            | Samsung        | Galaxy Note 10.1 (N8020)  | Exynos 4 Quad 4412 | 2012-12-01   | U      |      843 |      0.02% |
| 254  | gtanotexlwifi    | Samsung        | Galaxy Tab A 10.1 S Pen … | Exynos 7870 Octa   | 2016-10-01   | U      |      843 |      0.02% |
| 256  | pyxis            | Xiaomi         | Mi CC 9, Mi 9 Lite        | Snapdragon 665     | 2019-07-01   | O      |      836 |      0.02% |
| 256  | guamp            | Motorola       | moto g9 play, moto g9, K… | Snapdragon 662     | 2020-08-01   | O      |      836 |      0.02% |
| 258  | s5neolte         | Samsung        | Galaxy S5 Neo             | Exynos 7580        | 2015-08-01   | D      |      830 |      0.02% |
| 259  | sofiar           | Motorola       | G8 Power                  | Snapdragon 665     | 2020-04-16   | U      |      828 |      0.02% |
| 260  | spes             | Xiaomi         | Redmi Note 11             | Snapdragon 680     | 2022-02-09   | U      |      813 |      0.02% |
| 261  | osprey           | Motorola       | moto g (2015)             | Snapdragon 410     | 2015-07-01   | D      |      812 |      0.02% |
| 262  | ali              | Motorola       | Moto G6, Moto 1S          | Snapdragon 450     | 2018-04-01   | U      |      810 |      0.02% |
| 263  | YTX703F          | Lenovo         | Yoga Tab 3 Plus Wi-Fi     | Snapdragon 652     | 2016-12-01   | D      |      804 |      0.02% |
| 264  | s2               | LeEco          | Le 2                      | Snapdragon 652     | 2016-04-01   | D      |      803 |      0.02% |
| 265  | android_x86      | virtual        | Android on x86            | x86                |              | U      |      802 |      0.02% |
| 266  | a51              | Samsung        | Galaxy A51 (SM-A515F)     | Exynos 9611        | 2019-12-16   | U      |      801 |      0.02% |
| 267  | jason            | Xiaomi         | Mi Note 3                 | Snapdragon 660     | 2017-09-01   | D      |      799 |      0.02% |
| 268  | kiev             | Motorola       | moto g 5G, moto one 5G a… | Snapdragon 750G    | 2020-05-01   | O      |      783 |      0.02% |
| 269  | shamu            | Google         | Nexus 6                   | Snapdragon 805     | 2014-10-29   | D      |      781 |      0.02% |
| 270  | jasmine_sprout   | Xiaomi         | Mi A2                     | Snapdragon 660     | 2018-07-01   | D      |      777 |      0.02% |
| 270  | gts3llte         | Samsung        | Galaxy Tab S3 9.7 LTE (S… | Snapdragon 820     | 2017-04-01   | U      |      777 |      0.02% |
| 270  | cepheus          | Xiaomi         | Mi 9                      | Snapdragon 855     | 2019-03-25   | U      |      777 |      0.02% |
| 273  | gtelwifiue       | Samsung        | Galaxy Tab E 9.6 (WiFi)   | Snapdragon 410     | 2015-07-01   | D      |      773 |      0.02% |
| 274  | j2y18lte         | Samsung        | Galaxy J2 2018            | Snapdragon 425     | 2018-01-01   | U      |      771 |      0.02% |
| 275  | grandneove3g     | Samsung        | Galaxy Grand Neo Plus     | Spreadtrum SC8830  | 2015-01-01   | U      |      769 |      0.02% |
| 276  | lt03lte          | Samsung        | Galaxy Note 10.1 2014 (L… | Snapdragon 800     | 2013-10-01   | D      |      767 |      0.02% |
| 277  | trlte            | Samsung        | Galaxy Note 4 (SM-N910F/… | Snapdragon 805     | 2014-10-01   | U      |      766 |      0.02% |
| 278  | fortuna3g        | Samsung        | Galaxy Grand Prime (SM-S… | Snapdragon 410     | 2014-10-01   | U      |      755 |      0.02% |
| 278  | earth            | Xiaomi         | Redmi 12C, Redmi 12C NFC… | Helio G85          | 2023-01-01   | O      |      755 |      0.02% |
| 280  | ginna            | Motorola       | Moto E (2020)             | Snapdragon 632     | 2020-06-10   | U      |      753 |      0.02% |
| 281  | marlin           | Google         | Pixel XL                  | Snapdragon 821     | 2016-10-01   | O      |      750 |      0.02% |
| 282  | nash             | Motorola       | moto z2 force, moto z (2… | Snapdragon 835     | 2017-07-01   | O      |      743 |      0.02% |
| 283  | zeroflte         | Samsung        | Galaxy S6 (SM-G920F)      | Exynos 7420 Octa … | 2015-04-01   | U      |      740 |      0.02% |
| 284  | hotdog           | OnePlus        | OnePlus 7T Pro            | Snapdragon 855+    | 2019-10-01   | O      |      738 |      0.02% |
| 285  | bullhead         | Google         | Nexus 5X                  | Snapdragon 808     | 2015-09-29   | D      |      736 |      0.02% |
| 286  | platina          | Xiaomi         | Mi 8 Lite                 | Snapdragon 660     | 2018-09-01   | D      |      734 |      0.02% |
| 287  | milletwifi       | Samsung        | Galaxy Tab 4 8.0 Wi-Fi    | Snapdragon 400     | 2014-06-01   | U      |      732 |      0.02% |
| 288  | begonia          | Xiaomi         | Redmi Note 8 Pro          | Helio G90T         | 2019-09-01   | U      |      727 |      0.02% |
| 289  | natrium          | Xiaomi         | Mi 5s Plus                | Snapdragon 821     | 2016-10-01   | O      |      721 |      0.02% |
| 290  | x86_64           |                | x86 64bits                | x86_64             |              | U      |      707 |      0.02% |
| 291  | chime            | Xiaomi         | Redmi 9T, Redmi 9 Power,… | Snapdragon 662     | 2021-01-18   | U      |      706 |      0.02% |
| 292  | gta4xl           | Samsung        | Galaxy Tab S6 Lite (LTE)  | Exynos 9611        | 2020-04-02   | O      |      683 |      0.02% |
| 293  | sailfish         | Google         | Pixel                     | Snapdragon 821     | 2016-10-01   | O      |      680 |      0.02% |
| 293  | fogo             | Motorola       | moto g 5G - 2024          | Snapdragon 765G    | 2020-05-01   | O      |      680 |      0.02% |
| 295  | Spacewar         | Nothing        | Phone (1)                 | Snapdragon 778G+ … | 2022-07-12   | O      |      677 |      0.02% |
| 296  | m1721            | Meizu          | M6 Note (m1721)           | Snapdragon 625     | 2017-09-01   | U      |      673 |      0.02% |
| 297  | thor             | Xiaomi         | Xiaomi 12S Ultra          | Snapdragon 8+ Gen1 | 2022-07-09   | O      |      666 |      0.02% |
| 297  | FP5              | Fairphone      | Fairphone 5               | Qualcomm QCM6490   | 2023-08-01   | O      |      666 |      0.02% |
| 299  | j7xelte          | Samsung        | J7 (2016) (J710F)         | Exynos 7870        | 2016-04-01   | U      |      665 |      0.02% |
| 300  | dubai            | Motorola       | edge 30                   | Snapdragon 778G+ … | 2022-05-01   | O      |      662 |      0.02% |
| 301  | rova             | Xiaomi         | Redmi 4A, Redmi 5A        | Snapdragon 425     | 2016-11-01   | U      |      658 |      0.02% |
| 302  | caprip           | Motorola       | moto g30, K13 Pro         | Snapdragon 662     | 2021-03-01   | O      |      652 |      0.02% |
| 303  | m8               | HTC            | One (M8)                  | Snapdragon 801     | 2014-03-01   | D      |      642 |      0.02% |
| 304  | a7xelte          | Samsung        | Galaxy A7 (2016)          | Exynos 7580        | 2015-12-01   | D      |      639 |      0.01% |
| 305  | n1a3g            | Samsung        | Galaxy Note 10.1 (2014) … | Exynos 5420        | 2013-10-01   | U      |      638 |      0.01% |
| 306  | federer          | Huawei         | MediaPad T2 10.0 Pro      | Snapdragon 615     | 2016-09-01   | U      |      637 |      0.01% |
| 307  | aries            | Xiaomi         | Mi 2                      | Snapdragon S4 Pro  | 2012-11-01   | U      |      636 |      0.01% |
| 308  | x86_64_tv_go     |                |                           | x86_64             |              | U      |      633 |      0.01% |
| 308  | munch            | Xiaomi         | POCO F4, Redmi K40S       | Snapdragon 870     | 2022-06-01   | O      |      633 |      0.01% |
| 310  | santoni          | Xiaomi         | Redmi 4(X)                | Snapdragon 435     | 2017-05-01   | D      |      631 |      0.01% |
| 311  | g0215d           | GREE           | G0215D                    | Snapdragon 820     | 2018-08-01   | U      |      616 |      0.01% |
| 312  | deb              | Google         | Nexus 7 2013 (LTE)        | Snapdragon S4 Pro  | 2013-07-26   | D      |      609 |      0.01% |
| 313  | rolex            | Xiaomi         | Redmi 4A                  | Snapdragon 425     | 2016-11-01   | U      |      606 |      0.01% |
| 314  | zeroltexx        | Samsung        | Galaxy S6 Edge            | Exynos 7420        | 2015-04-01   | D      |      605 |      0.01% |
| 315  | cheetah          | Google         | Pixel 7 Pro               | Tensor GS201       | 2022-10-13   | O      |      602 |      0.01% |
| 316  | gts28wifi        | Samsung        | Galaxy Tab S2 (8.0”, Wi-… | Exynos 5 Octa 5433 | 2015-09-01   | U      |      596 |      0.01% |
| 317  | hermes           | Xiaomi         | Redmi Note 2              | Helio X10          | 2015-08-14   | U      |      594 |      0.01% |
| 318  | cupid            | Xiaomi         | Xiaomi 12                 | Snapdragon 8 Gen1  | 2021-12-31   | O      |      591 |      0.01% |
| 319  | akita            | Google         | Pixel 8a                  | Tensor G3          | 2023-10-04   | O      |      584 |      0.01% |
| 320  | falcon           | Motorola       | moto g                    | Snapdragon 400     | 2013-11-01   | D      |      582 |      0.01% |
| 321  | akari            | Sony           | Xperia XZ2                | Snapdragon 845     | 2018-04-01   | O      |      580 |      0.01% |
| 322  | cancro           | Xiaomi         | Mi 3, Mi 4                | Snapdragon 800     | 2013-10-01   | D      |      579 |      0.01% |
| 323  | d2x              | Samsung        | Galaxy Note10+ 5G         | Exynos 9825        | 2019-08-23   | O      |      577 |      0.01% |
| 324  | golden           | Samsung        | Galaxy S3 Mini, Galaxy S… | NovaThor U8420     | 2012-11-01   | U      |      576 |      0.01% |
| 325  | odroidn2         | HardKernel     | ODROID-N2                 | Amlogic S922X      | 2019-02-01   | U      |      575 |      0.01% |
| 326  | onyx             | OnePlus        | OnePlus X                 | Snapdragon 801     | 2015-11-01   | D      |      572 |      0.01% |
| 326  | dre              | OnePlus        | OnePlus Nord N200         | Snapdragon 480     | 2021-06-21   | O      |      572 |      0.01% |
| 328  | gracerlte        | Samsung        | Galaxy Note FE, Galaxy N… | Exynos 8890 (14nm) | 2016-08-19   | U      |      563 |      0.01% |
| 329  | i9082            | Samsung        | Galaxy Grand Duos i9082,… | Broadcom BCM28155  | 2013-01-01   | U      |      561 |      0.01% |
| 330  | billie           | OnePlus        | OnePlus Nord N10          | Snapdragon 690 5G  | 2020-10-26   | D      |      557 |      0.01% |
| 331  | starfire         | Lenovo         | ThinkSmart View (CD-1878… | Qualcomm APQ8053   | 2020-08-01   | U      |      554 |      0.01% |
| 332  | latte            | Xiaomi         | Mi Pad 2                  | Atom X5-Z8500      | 2015-11-01   | U      |      553 |      0.01% |
| 333  | raven            | Google         | Pixel 6 Pro               | Tensor GS101       | 2021-10-19   | O      |      550 |      0.01% |
| 334  | j3xlte           | Samsung        | Galaxy J3 (2016) (SM-J32… | Spreadtrum SC9830A | 2016-05-06   | U      |      542 |      0.01% |
| 335  | salami           | OnePlus        | OnePlus 11 5G             | Snapdragon 8 Gen2  | 2023-01-01   | O      |      541 |      0.01% |
| 336  | j3xnlte          | Samsung        | Galaxy J3 (2016) (SM-J32… | Spreadtrum SC9830I | 2016-05-06   | U      |      539 |      0.01% |
| 337  | twolip           | Xiaomi         | Redmi Note 6 Pro          | Snapdragon 636     | 2018-10-01   | D      |      537 |      0.01% |
| 338  | haydn            | Xiaomi         | Mi 11i, Redmi K40 Pro, R… | Snapdragon 888     | 2021-01-01   | O      |      533 |      0.01% |
| 339  | perseus          | Xiaomi         | Mi MIX 3                  | Snapdragon 845     | 2018-11-01   | O      |      528 |      0.01% |
| 340  | angelica         | Xiaomi         | Redmi 9C                  | Helio G35 (12 nm)  | 2020-08-12   | U      |      527 |      0.01% |
| 341  | dodge            | OnePlus        | 13                        | Snapdragon 8 Elite | 2024-11-01   | O      |      521 |      0.01% |
| 342  | maple_dsds       | Sony           | Xperia XZ Premium Dual S… | Snapdragon 835     | 2017-06-18   | U      |      518 |      0.01% |
| 343  | bach             | Huawei         | MediaPad M3 Lite 8, Medi… | Snapdragon 435     | 2017-06-01   | U      |      517 |      0.01% |
| 344  | j7velte          | Samsung        | Galaxy J7 NXT (J701F)     | Exynos 7870 Octa   | 2017-07-01   | U      |      512 |      0.01% |
| 345  | shiba            | Google         | Pixel 8                   | Tensor G3          | 2023-10-04   | O      |      511 |      0.01% |
| 346  | lt013g           | Samsung        | Galaxy Tab III 8.0 3G, G… | Exynos 4212 Dual   | 2013-07-01   | U      |      509 |      0.01% |
| 346  | berlin           | Motorola       | edge 20                   | Snapdragon 778G 5G | 2021-07-29   | O      |      509 |      0.01% |
| 348  | j2lte            | Samsung        | Galaxy J2 (J200M/F/G/GU/… | Exynos 3475 Quad   | 2015-09-01   | U      |      505 |      0.01% |
| 348  | a3y17lte         | Samsung        | Galaxy A3 (2017) (SM-A32… | Exynos 7870 Octa   | 2017-01-01   | U      |      505 |      0.01% |
| 350  | angler           | Google         | Nexus 6P                  | Snapdragon 810     | 2015-09-29   | D      |      503 |      0.01% |
| 351  | millet3g         | Samsung        | Galaxy Tab 4 8.0 3G       | Snapdragon 400     | 2014-06-01   | U      |      501 |      0.01% |
| 352  | i9100            | Samsung        | Galaxy S II               | Exynos 4210        | 2011-02-11   | D      |      494 |      0.01% |
| 353  | athene           | Motorola       | moto g4                   | Snapdragon 617     | 2016-05-01   | D      |      493 |      0.01% |
| 354  | wseries          |                |                           |                    |              | U      |      492 |      0.01% |
| 355  | cereus           | Xiaomi         | Redmi 6                   | Helio P22 (12 nm)  | 2018-06-01   | U      |      491 |      0.01% |
| 356  | zerolte          | Samsung        | Galaxy S6 Edge (SM-G925F) | Exynos 7420 Octa   | 2015-04-10   | U      |      489 |      0.01% |
| 357  | kuntao           | Lenovo         | P2                        | Snapdragon 625     | 2016-11-01   | D      |      487 |      0.01% |
| 358  | barbet           | Google         | Pixel 5a                  | Snapdragon 765G    | 2021-08-01   | O      |      485 |      0.01% |
| 359  | jasmine          | ZTE            | AT&T Trek 2 HD            | Snapdragon 617     | 2016-08-01   | D      |      479 |      0.01% |
| 359  | a3lte            | Samsung        | Galaxy A3 (2015)          | Snapdragon 410     | 2014-12-01   | U      |      479 |      0.01% |
| 361  | gts28ltexx       | Samsung        | Galaxy Tab S2 9.7 G3/LTE… | Exynos 5433        | 2015-09-01   | U      |      478 |      0.01% |
| 362  | pdx206           | Sony           | Xperia 5 II               | Snapdragon 865     | 2020-09-01   | O      |      477 |      0.01% |
| 363  | s3ve3gjv         | Samsung        | Galaxy S III Neo (Samsun… | Snapdragon 400     | 2014-04-11   | D      |      476 |      0.01% |
| 364  | waffle           | OnePlus        | OnePlus 12                | Snapdragon 8 Gen3  | 2023-12-01   | O      |      472 |      0.01% |
| 365  | pdx215           | Sony           | Xperia 1 III              | Snapdragon 888     | 2021-04-01   | O      |      468 |      0.01% |
| 366  | topaz            | Xiaomi         | Redmi Note 12 4G, Redmi … | Snapdragon 685     | 2023-03-01   | U      |      464 |      0.01% |
| 366  | jfvelte          | Samsung        | Galaxy S4 Value Edition … | Snapdragon 600     | 2014-04-01   | D      |      464 |      0.01% |
| 368  | a505f            | Samsung        | Galaxy A50                | Exynos 9610        | 2019-03-18   | U      |      459 |      0.01% |
| 369  | mondrian         | Xiaomi         | POCO F5 Pro, Redmi K60    | Snapdragon 8+ Gen1 | 2022-12-27   | O      |      458 |      0.01% |
| 370  | ingres           | Xiaomi         | Poco F4 GT, Redmi K50 Ga… | Snapdragon 8 Gen 1 | 2022-04-28   | U      |      456 |      0.01% |
| 371  | pdx203           | Sony           | Xperia 1 II               | Snapdragon 865     | 2020-05-01   | O      |      453 |      0.01% |
| 372  | gts210velte      | Samsung        | Galaxy Tab S2 9.7 LTE (S… | Snapdragon 652     | 2015-09-01   | U      |      452 |      0.01% |
| 373  | gta2xlwifi       | Samsung        | Galaxy Tab A 10.5 (2018)… | Snapdragon 450     | 2018-08-01   | U      |      451 |      0.01% |
| 374  | serrano3gxx      | Samsung        | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |      450 |      0.01% |
| 374  | gts7lwifi        | Samsung        | Galaxy Tab S7 (Wi-Fi)     | Snapdragon 865+    | 2020-08-21   | O      |      450 |      0.01% |
| 376  | cannon           | Xiaomi         | Redmi Note 9 5G, Redmi N… | Dimensity 800U     | 2020-12-01   | U      |      449 |      0.01% |
| 377  | fleur            | Xiaomi         | Redmi Note 11S, POCO M4 … | Helio G96 (12 nm)  | 2022-02-09   | U      |      447 |      0.01% |
| 378  | ugglite          | Xiaomi         | Redmi Y1, Redmi Note 5A,… | Snapdragon 435     | 2017-08-21   | U      |      445 |      0.01% |
| 379  | ks01ltexx        | Samsung        | Galaxy S4 LTE-A (GT-I950… | Snapdragon 800     | 2013-10-01   | U      |      444 |      0.01% |
| 380  | flashlmdd        | LG             | V50 ThinQ                 | Snapdragon 855     | 2019-02-01   | D      |      442 |      0.01% |
| 381  | foster           | NVIDIA         | Shield TV (2015 / 2015 P… | Tegra X1 (T210)    | 2015-05-28   | O      |      441 |      0.01% |
| 382  | t0lte            | Samsung        | Galaxy Note 2 (LTE)       | Exynos 4412        | 2012-09-01   | D      |      439 |      0.01% |
| 383  | x1s              | Samsung        | Galaxy S20, Galaxy S20 5G | Exynos 990         | 2020-03-06   | O      |      436 |      0.01% |
| 383  | serranodsdd      | Samsung        | Galaxy S4 Mini (Internat… | Snapdragon 400     | 2013-07-01   | D      |      436 |      0.01% |
| 383  | nio              | Motorola       | edge s, moto g100         | Snapdragon 870     | 2021-02-01   | O      |      436 |      0.01% |
| 386  | s3ve3gds         | Samsung        | Galaxy S III Neo (Dual S… | Snapdragon 400     | 2014-04-11   | D      |      435 |      0.01% |
| 387  | aura             | Razer          | Phone 2                   | Snapdragon 845     | 2018-10-01   | O      |      432 |      0.01% |
| 388  | d1x              | Samsung        | Galaxy Note10 5G          | Exynos 9825        | 2019-08-23   | O      |      431 |      0.01% |
| 389  | equuleus         | Xiaomi         | Mi 8 Pro                  | Snapdragon 845     | 2018-09-01   | O      |      428 |      0.01% |
| 389  | R9s              | OPPO           | R9s, R9sk                 | Snapdragon 625     | 2016-10-01   | U      |      428 |      0.01% |
| 391  | sheldon          | Amazon         | Fire TV Stick Lite, Fire… | MediaTek MT8695D   | 2020-09-30   | U      |      427 |      0.01% |
| 391  | ido              | Xiaomi         | Redmi 3, Redmi 3 Prime    | Snapdragon 616     | 2016-01-01   | D      |      427 |      0.01% |
| 393  | raphael          | Xiaomi         | Redmi K20 Pro, Mi 9T Pro  | Snapdragon 855     | 2019-08-20   | U      |      426 |     0.010% |
| 394  | xpeng            | Motorola       | moto g200 5G, Edge S30    | Snapdragon 888+    | 2021-11-01   | O      |      425 |     0.010% |
| 395  | x103f            | Lenovo         | Tab 10, Tab3 10 (TB-X103… | Snapdragon 210 or… | 2016-06-01   | U      |      421 |     0.010% |
| 396  | akatsuki         | Sony           | Xperia XZ3                | Snapdragon 845     | 2018-10-01   | O      |      420 |     0.010% |
| 397  | husky            | Google         | Pixel 8 Pro               | Tensor G3          | 2023-10-04   | O      |      417 |     0.010% |
| 398  | hawao            | Motorola       | moto g42                  | Snapdragon 680 4G  | 2022-06-01   | O      |      414 |     0.010% |
| 399  | mh2lm            | LG             | G8X ThinQ (G850EM/EMW), … | Snapdragon 855     | 2019-06-01   | D      |      412 |     0.010% |
| 399  | kirin            | Sony           | Xperia 10                 | Snapdragon 630     | 2019-02-01   | O      |      412 |     0.010% |
| 401  | TB8704           | Lenovo         | Tab 4 8 Plus (Wi-Fi)      | Snapdragon 625     | 2017-07-01   | U      |      411 |     0.010% |
| 401  | Mi439_4_19       | Xiaomi         | Redmi 8A                  | Snapdragon 439     | 2019-10-01   | U      |      411 |     0.010% |
| 403  | j7y17lte         | Samsung        | Galaxy J7 Pro             | Exynos 7870 Octa   | 2017-07-01   | U      |      410 |     0.010% |
| 403  | garnet           | Xiaomi         | Redmi Note13 Pro 5G, Poc… | Snapdragon 7s Gen… | 2023-09-26   | U      |      410 |     0.010% |
| 405  | kugo             | Sony           | Xperia X Compact          | Snapdragon 650     | 2016-09-08   | D      |      409 |     0.010% |
| 406  | x1q              | Samsung        | Galaxy S20                | Exynos 990         | 2020-03-06   | U      |      408 |     0.010% |
| 406  | gtanotexllte     | Samsung        | Galaxy Tab A 10.1 (2016)… | Exynos 7870 Octa   | 2016-05-01   | U      |      408 |     0.010% |
| 408  | kyleproxx        | Samsung        | Galaxy S Duos 2           | Broadcom BCM 2814… | 2013-12-01   | U      |      406 |     0.010% |
| 409  | m7               | HTC            | One (GSM)                 | Snapdragon 600     | 2013-03-01   | D      |      405 |     0.009% |
| 410  | waydroid_arm64_… | virtual        | Waydroid ARM64            | ARM64              |              | U      |      402 |     0.009% |
| 411  | d1               | Samsung        | Galaxy Note10             | Exynos 9825        | 2019-08-23   | O      |      401 |     0.009% |
| 411  | cmi              | Xiaomi         | Mi 10 Pro                 | Snapdragon 865     | 2020-02-01   | O      |      401 |     0.009% |
| 413  | tucana           | Xiaomi         | Mi Note 10, Mi Note 10 P… | Snapdragon 730G    | 2019-11-11   | O      |      398 |     0.009% |
| 413  | j5nlte           | Samsung        | Galaxy J5 (2015) (SM-J50… | Snapdragon 410     | 2015-07-28   | U      |      398 |     0.009% |
| 413  | fuxi             | Xiaomi         | Xiaomi 13                 | Snapdragon 8 Gen2  | 2022-12-11   | O      |      398 |     0.009% |
| 416  | selene           | Xiaomi         | Redmi 10                  | Helio G88          | 2021-08-20   | U      |      397 |     0.009% |
| 416  | hulkbuster       |                |                           |                    |              | U      |      397 |     0.009% |
| 418  | zenlte           | Samsung        | Galaxy S6 Edge+           | Exynos 7420 Octa   | 2015-08-01   | U      |      396 |     0.009% |
| 419  | a72q             | Samsung        | Galaxy A72                | Snapdragon 720G    | 2021-03-26   | O      |      395 |     0.009% |
| 420  | oxygen           | Xiaomi         | Mi Max 2                  | Snapdragon 625     | 2017-06-01   | U      |      391 |     0.009% |
| 421  | trelteskt        | Samsung        | Galaxy Note 4 (N910S/L/K) | Snapdragon 805     | 2014-10-01   | U      |      386 |     0.009% |
| 422  | stone            | Xiaomi         | Redmi Note 12, Redmi Not… | Snapdragon 4 Gen 1 | 2023-01-11   | U      |      384 |     0.009% |
| 423  | camellia         | Xiaomi         | Redmi Note 10T, Redmi No… | Dimensity 700      | 2021-07-26   | U      |      382 |     0.009% |
| 424  | nairo            | Motorola       | moto g 5G plus, moto one… | Snapdragon 662     | 2020-05-01   | O      |      379 |     0.009% |
| 425  | lemonades        | OnePlus        | OnePlus 9R                | Snapdragon 888     | 2021-03-01   | O      |      378 |     0.009% |
| 426  | Pong             | Nothing        | Phone (2)                 | Snapdragon 8+ Gen1 | 2023-07-11   | O      |      375 |     0.009% |
| 427  | judyln           | LG             | G7 ThinQ (G710AWM/EM/EMW… | Snapdragon 845     | 2018-05-02   | O      |      374 |     0.009% |
| 428  | markw            | Xiaomi         | Redmi 4 Prime             | Snapdragon 625     | 2016-11-01   | U      |      372 |     0.009% |
| 429  | capricorn        | Xiaomi         | Mi 5s                     | Snapdragon 821     | 2016-10-01   | D      |      370 |     0.009% |
| 430  | zeus             | Xiaomi         | Xiaomi 12 Pro             | Snapdragon 8 Gen1  | 2021-12-31   | O      |      367 |     0.009% |
| 430  | lt033g           | Samsung        | Galaxy Note 10.1 2014 Ed… | Exynos 5420        | 2013-10-10   | U      |      367 |     0.009% |
| 432  | rtwo             | Motorola       | edge 40 pro, moto X40 ed… | Snapdragon 8 Gen2  | 2023-04-01   | O      |      366 |     0.009% |
| 432  | discovery        | Sony           | Xperia XA2 Ultra          | Snapdragon 630     | 2018-02-01   | O      |      366 |     0.009% |
| 434  | veux             | Xiaomi         | POCO X4 Pro 5G            | Snapdragon 695 5G  | 2022-03-23   | U      |      365 |     0.009% |
| 435  | gt510lte         | Samsung        | Galaxy Tab A 9.7 (SM-T55… | Snapdragon 410     | 2015-05-01   | U      |      364 |     0.009% |
| 435  | cebu             | Motorola       | moto g9 power, K12 Pro    | Snapdragon 662     | 2020-11-01   | O      |      364 |     0.009% |
| 437  | titan            | Motorola       | moto g (2014)             | Snapdragon 400     | 2014-06-01   | D      |      362 |     0.008% |
| 438  | j53gxx           | Samsung        | Galaxy J5 (2015)          | Snapdragon 410     | 2015-07-28   | U      |      359 |     0.008% |
| 439  | riva             | Xiaomi         | Redmi 5A                  | Snapdragon 425     | 2017-12-01   | U      |      357 |     0.008% |
| 440  | borneo           | Motorola       | moto g power 2021         | Snapdragon 662     | 2021-01-01   | O      |      356 |     0.008% |
| 441  | gt5note10wifi    | Samsung        | Galaxy Tab A 9.7 Wi-Fi (… | Snapdragon 410     | 2015-05-01   | U      |      349 |     0.008% |
| 441  | TB8504           | Lenovo         | Tab4 8, Tab 4 8           | Snapdragon 425     | 2017-09-15   | U      |      349 |     0.008% |
| 443  | surnia           | Motorola       | moto e LTE (2015)         | Snapdragon 410     | 2015-02-01   | D      |      348 |     0.008% |
| 443  | DRG              | Nokia          | Nokia 6.1 Plus            | Snapdragon 636     | 2018-08-30   | D      |      348 |     0.008% |
| 445  | wt88047          | Wingtech       | Redmi 2                   | Snapdragon 410     | 2015-01-01   | D      |      347 |     0.008% |
| 446  | guam             | Motorola       | moto e7 plus, K12         | Snapdragon 460     | 2020-09-16   | O      |      345 |     0.008% |
| 447  | sumire           | Sony           | Xperia Z5                 | Snapdragon 810     | 2015-09-01   | D      |      342 |     0.008% |
| 448  | tangorpro        | Google         | Pixel Tablet              | Tensor GS201       | 2023-06-10   | O      |      341 |     0.008% |
| 448  | grouper          | ASUS           | Nexus 7 2012              | Tegra 3            | 2012-07-01   | U      |      341 |     0.008% |
| 450  | mondrianlte      | Samsung        | Galaxy Tab Pro 8.4 LTE (… | Snapdragon 800     | 2014-03-01   | U      |      340 |     0.008% |
| 451  | timelm           | LG             | V60 ThinQ 5G              | Snapdragon 865 5G  | 2020-03-20   | U      |      336 |     0.008% |
| 451  | s3ve3gxx         | Samsung        | Galaxy S III Neo (Sony C… | Snapdragon 400     | 2014-04-11   | D      |      336 |     0.008% |
| 453  | pdx214           | Sony           | Xperia 5 III              | Snapdragon 888     | 2021-04-01   | O      |      335 |     0.008% |
| 454  | pollux_windy     | Sony           | Xperia Tablet Z Wi-Fi     | Snapdragon S4 Pro  | 2013-02-01   | D      |      333 |     0.008% |
| 455  | z2_plus          | ZUK            | Z2 Plus                   | Snapdragon 820     | 2016-06-01   | D      |      332 |     0.008% |
| 456  | castor_windy     | Sony           | Xperia Tablet Z2 Wi-Fi    | Snapdragon 801     | 2014-03-26   | D      |      329 |     0.008% |
| 457  | zl1              | LeEco          | Le Pro3, Le Pro3 Elite    | Snapdragon 821     | 2016-10-01   | D      |      328 |     0.008% |
| 458  | z3tcw            | Sony           | Xperia Z3 Tablet Compact… | Snapdragon 801     | 2014-11-01   | U      |      327 |     0.008% |
| 459  | komodo           | Google         | Pixel 9 Pro XL            | Tensor G4          | 2024-08-22   | O      |      324 |     0.008% |
| 459  | hltetmo          | Samsung        | Galaxy Note 3 LTE (N900T… | Snapdragon 800     | 2013-09-01   | D      |      324 |     0.008% |
| 461  | grandprimeve3g   | Samsung        | Galaxy Grand Prime        | Snapdragon 410     | 2014-10-01   | U      |      323 |     0.008% |
| 462  | RM6785           | Realme         | 6, 6i, 6s, Narzo, 7, Nar… | Mediatek MT6785    | 2020-03-11   | U      |      322 |     0.008% |
| 463  | diting           | Xiaomi         | Xiaomi 12T Pro, Redmi K5… | Snapdragon 8+ Gen1 | 2022-08-25   | O      |      321 |     0.008% |
| 464  | pdx234           | Sony           | Xperia 1 V                | Snapdragon 8 Gen2  | 2023-05-01   | O      |      320 |     0.008% |
| 465  | bardockpro       | BQ             | Aquaris X Pro             | Snapdragon 626     | 2017-06-01   | D      |      315 |     0.007% |
| 466  | TBX304           | Lenovo         | Tab4 8, Tab4 10 WIFI      | Qualcomm APQ8017   | 2017-07-01   | U      |      314 |     0.007% |
| 467  | duchamp          | Xiaomi         | Redmi K70E, Poco X6 Pro … | Dimensity 8300 Ul… | 2023-11-29   | U      |      312 |     0.007% |
| 467  | dragon           | Google         | Pixel C                   | Tegra X1 (T210)    | 2015-12-08   | D      |      312 |     0.007% |
| 469  | Z01R             | ASUS           | Zenfone 5Z (ZS620KL)      | Snapdragon 845     | 2018-06-01   | O      |      311 |     0.007% |
| 470  | karin            | Sony           | Xperia Z4 Tablet LTE      | Snapdragon 810     | 2015-10-01   | D      |      310 |     0.007% |
| 471  | phoenix          | Xiaomi         | Redmi K30                 | Snapdragon 730G    | 2019-12-01   | U      |      307 |     0.007% |
| 472  | v1a3g            | Samsung        | Galaxy Note Pro 12.2      | Exynos 5420 Octa   | 2014-02-01   | U      |      306 |     0.007% |
| 472  | hanoip           | Motorola       | Moto G60, Moto G40 Fusion | Snapdragon 732G    | 2021-04-27   | U      |      306 |     0.007% |
| 474  | suzuran          | Sony           | Xperia Z5 Compact         | Snapdragon 810     | 2015-10-01   | D      |      305 |     0.007% |
| 475  | spaced           | Realme         | 8i, Narzo 50              | Helio G96 MT6781 … | 2021-09-14   | U      |      303 |     0.007% |
| 476  | miami            | Motorola       | edge 30 neo               | Snapdragon 695     | 2022-10-07   | O      |      301 |     0.007% |
| 477  | kminilte         | Samsung        | Galaxy S5 Mini            | Exynos 3470 Quad   | 2014-07-01   | U      |      299 |     0.007% |
| 478  | beckham          | Motorola       | moto z3 play              | Snapdragon 636     | 2018-06-01   | O      |      296 |     0.007% |
| 478  | aston            | OnePlus        | OnePlus 12R, ACE 3        | Snapdragon 8 Gen2  | 2024-01-01   | O      |      296 |     0.007% |
| 480  | hltedcm          | Samsung        | Galaxy Note 3 (Docomo SC… | Snapdragon 800     | 2013-09-01   | U      |      294 |     0.007% |
| 481  | a5lte            | Samsung        | Galaxy A5 (A500F)         | Snapdragon 410     | 2014-12-01   | U      |      293 |     0.007% |
| 482  | castor           | Sony           | Xperia Tablet Z2 LTE      | Snapdragon 801     | 2014-03-26   | D      |      289 |     0.007% |
| 483  | martini          | OnePlus        | OnePlus 9RT               | Snapdragon 888     | 2021-10-01   | O      |      287 |     0.007% |
| 483  | maple            | Sony           | Xperia XZ Premium         | Snapdragon 835     | 2017-06-18   | U      |      287 |     0.007% |
| 485  | suzu             | Sony           | Xperia X                  | Snapdragon 650     | 2016-05-01   | D      |      283 |     0.007% |
| 485  | ocn              | HTC            | U11                       | Snapdragon 835     | 2017-06-10   | U      |      283 |     0.007% |
| 487  | m52xq            | Samsung        | Galaxy M52 5G             | Snapdragon 778G 5G | 2021-10-03   | O      |      281 |     0.007% |
| 487  | YTX703L          | Lenovo         | Yoga Tab 3 Plus LTE       | Snapdragon 652     | 2016-12-01   | D      |      281 |     0.007% |
| 489  | kltekor          | Samsung        | Galaxy S5 LTE (G900K/L/S) | Snapdragon 801     | 2014-04-01   | D      |      280 |     0.007% |
| 489  | d802             | LG             | G2 (International)        | Snapdragon 800     | 2013-09-12   | D      |      280 |     0.007% |
| 491  | crown            | Samsung        | Galaxy J7 Crown (SM-S767… |                    |              | U      |      278 |     0.007% |
| 492  | j6lte            | Samsung        | Galaxy J6                 | Exynos 7870        | 2018-05-01   | U      |      274 |     0.006% |
| 493  | oscaro           | OnePlus        | OnePlus Nord CE 2 Lite 5G | Snapdragon 695     | 2022-04-30   | O      |      268 |     0.006% |
| 494  | lava             | Xiaomi         | Redmi 9, Poco M2          | Helio G80          | 2020-06-10   | U      |      267 |     0.006% |
| 495  | a73xq            | Samsung        | Galaxy A73 5G             | Snapdragon 778G 5G | 2022-04-22   | O      |      266 |     0.006% |
| 496  | zenfone3         | ASUS           | Zenfone 3                 | Snapdragon 625     | 2016-05-30   | D      |      265 |     0.006% |
| 496  | gts28velte       | Samsung        | Galaxy Tab S2 8.0 (T719)  | Snapdragon 652     | 2016-07-01   | U      |      265 |     0.006% |
| 498  | sunny            | Xiaomi         | Redmi Note 10             | Snapdragon 678     | 2021-03-16   | U      |      264 |     0.006% |
| 499  | pstar            | Motorola       | edge 20 pro               | Snapdragon 870     | 2021-08-01   | O      |      262 |     0.006% |
| 500  | v2awifi          | Samsung        | Galaxy Tab Pro 12.2 WiFi  | Exynos 5420 Octa   | 2014-03-01   | U      |      261 |     0.006% |
| 500  | klteduos         | Samsung        | Galaxy S5 LTE Duos (G900… | Snapdragon 801     | 2014-06-01   | D      |      261 |     0.006% |
| 500  | judypn           | LG             | V40 ThinQ                 | Snapdragon 845     | 2018-10-03   | O      |      261 |     0.006% |
| 503  | sakura           | Xiaomi         | Redmi 6 Pro, Mi A2 Lite   | Snapdragon 625     | 2018-07-01   | U      |      259 |     0.006% |
| 503  | rhodep           | Motorola       | moto g82 5G               | Snapdragon 695     | 2022-06-07   | O      |      259 |     0.006% |
| 503  | manta            | Google         | Nexus 10                  | Exynos 5250        | 2012-11-13   | D      |      259 |     0.006% |
| 506  | virtio_arm64only | virtual        |                           | ARM64              |              | U      |      257 |     0.006% |
| 506  | serranovelte     | Samsung        | Galaxy S4 Mini (GT-I9195… | Snapdragon 410     | 2015-06-01   | U      |      257 |     0.006% |
| 508  | caiman           | Google         | Pixel 9 Pro               | Tensor G4          | 2024-09-09   | O      |      254 |     0.006% |
| 509  | hltechn          | Samsung        | Galaxy Note 3 LTE (N9008… | Snapdragon 800     | 2013-09-01   | D      |      253 |     0.006% |
| 510  | picassolte       | Samsung        | Galaxy Tab Pro 10.1 LTE … | Snapdragon 800     | 2014-03-01   | U      |      250 |     0.006% |
| 511  | nitrogen         | Xiaomi         | Mi MAX 3                  | Snapdragon 636     | 2018-07-01   | U      |      248 |     0.006% |
| 512  | d855             | LG             | G3 (International)        | Snapdragon 801     | 2014-06-01   | D      |      244 |     0.006% |
| 513  | m31              | Samsung        | Galaxy M31                | Exynos 9611        | 2020-03-05   | U      |      241 |     0.006% |
| 513  | dm1q             | Samsung        | Galaxy S23                | Snapdragon 8 Gen 2 | 2023-02-17   | U      |      241 |     0.006% |
| 515  | bardock          | BQ             | Aquaris X                 | Snapdragon 626     | 2017-06-01   | D      |      240 |     0.006% |
| 516  | sky              | Xiaomi         | Redmi 12, POCO M6 Pro 5G  | Snapdragon 4 Gen 2 | 2023-08-04   | U      |      238 |     0.006% |
| 516  | milletlte        | Samsung        | Galaxy Tab4 8.0 LTE (SM-… | Snapdragon 400     | 2014-06-01   | U      |      238 |     0.006% |
| 518  | santos10lte      | Samsung        | Galaxy Tab 3 10.1 LTE (G… | Atom Z2560         | 2013-07-07   | U      |      237 |     0.006% |
| 518  | m23xq            | Samsung        | Galaxy M23, Galaxy F23 5G | Snapdragon 750G 5G | 2022-04-08   | U      |      237 |     0.006% |
| 520  | shieldtablet     | NVIDIA         | Shield Tablet             | Tegra K1 (T124)    | 2014-07-29   | D      |      232 |     0.005% |
| 520  | racer            | Motorola       | edge                      | Snapdragon 765G    | 2020-05-01   | D      |      232 |     0.005% |
| 522  | ovaltine         | OnePlus        | 10T 5G                    | Snapdragon 8+ Gen… | 2022-08-06   | U      |      231 |     0.005% |
| 523  | kltedv           | Samsung        | Galaxy S5 LTE (G900I/P)   | Snapdragon 801     | 2014-04-01   | D      |      230 |     0.005% |
| 523  | j5y17lte         | Samsung        | Galaxy J5 (2017) (SM-J53… | Exynos 7870 Octa   | 2017-06-01   | U      |      230 |     0.005% |
| 525  | kiwi             | Huawei         | Honor 5X                  | Snapdragon 616     | 2015-11-01   | D      |      229 |     0.005% |
| 526  | togari           | Sony           | Xperia Z Ultra            | Snapdragon 800     | 2013-07-01   | U      |      225 |     0.005% |
| 527  | sea              | Xiaomi         | Redmi Note 12S            | Helio G96 (12 nm)  | 2023-04-26   | U      |      223 |     0.005% |
| 528  | a40              | Samsung        | Galaxy A40                | Exynos 7904        | 2019-04-01   | U      |      222 |     0.005% |
| 529  | alphaplus        | LG             | G8 ThinQ, G8 ThinQ (Kore… | Snapdragon 855     | 2019-02-01   | D      |      221 |     0.005% |
| 530  | pollux           | Sony           | Xperia Tablet Z LTE       | Snapdragon S4 Pro  | 2013-02-01   | D      |      219 |     0.005% |
| 530  | pine             | Xiaomi         | Redmi 7A                  | Snapdragon 439     | 2019-07-04   | U      |      219 |     0.005% |
| 532  | z3               | Sony           | Xperia Z3                 | Snapdragon 801     | 2014-09-04   | D      |      218 |     0.005% |
| 533  | poplar           | Sony           | Xperia XZ1 (G8341)        | Snapdragon 835     | 2017-09-19   | U      |      217 |     0.005% |
| 534  | sapphire         | Xiaomi         | Redmi Note 13 4G, Redmi … | Snapdragon 685     | 2024-01-15   | U      |      216 |     0.005% |
| 534  | gt5note10lte     | Samsung        | Galaxy Tab A 9.7 LTE (SM… | Snapdragon 410     | 2015-06-01   | U      |      216 |     0.005% |
| 536  | pdx235           | Sony           | Xperia 10 V               | Snapdragon 695     | 2023-06-21   | O      |      213 |     0.005% |
| 536  | land             | Xiaomi         | Redmi 3S, Redmi 3X        | Snapdragon 430     | 2016-06-01   | D      |      213 |     0.005% |
| 536  | A102             | Micromax       | Canvas Doodle 3 (A102)    | Mediatek MT6572    | 2014-04-01   | U      |      213 |     0.005% |
| 539  | oce              | HTC            | U Ultra, Ocean Note       | Snapdragon 821     | 2017-02-21   | U      |      212 |     0.005% |
| 539  | FP2              | Fairphone      | Fairphone 2               | Snapdragon 801     | 2015-12-01   | D      |      212 |     0.005% |
| 541  | xun              | Xiaomi         | Redmi Pad SE              | Snapdragon 680 4G  | 2023-09-01   | U      |      211 |     0.005% |
| 541  | amami            | Sony           | Xperia Z1 compact         | Snapdragon 800     | 2014-01-01   | U      |      211 |     0.005% |
| 543  | sirius           | Sony           | Xperia Z2                 | Snapdragon 801     | 2014-04-01   | D      |      210 |     0.005% |
| 544  | r8s              | Samsung        | Galaxy S20 FE (SM-G780F)  | Exynos 990         | 2020-10-02   | U      |      209 |     0.005% |
| 545  | grandprimevelte  | Samsung        | Galaxy Grand Prime VE LTE | Marvell PXA1908    | 2015-07-29   | U      |      208 |     0.005% |
| 546  | pipa             | Xiaomi         | Pad 6                     | Snapdragon 870 5G  | 2023-04-18   | U      |      207 |     0.005% |
| 546  | addison          | Motorola       | moto z play               | Snapdragon 625     | 2016-09-01   | D      |      207 |     0.005% |
| 546  | RMX2185          | Realme         | C11                       | Helio G35          | 2020-07-07   | U      |      207 |     0.005% |
| 549  | amar_row_lte     | Lenovo         | Tab M10 HD (2nd Gen)      | Helio P22T         | 2020-11-01   | U      |      206 |     0.005% |
| 550  | n8000_deodexed   | Samsung        | Galaxy Note 10.1 3G (GT-… | Exynos 4412 Quad   | 2012-08-01   | U      |      205 |     0.005% |
| 550  | TB2-X30L         | Lenovo         | TAB 2 A10-30 (TB2-X30L)   | Snapdragon 210     | 2015-10-29   | U      |      205 |     0.005% |
| 552  | pdx225           | Sony           | Xperia 10 IV              | Snapdragon 695     | 2022-06-30   | O      |      201 |     0.005% |
| 553  | apollo           | Xiaomi         | Mi 10T 5G, Mi 10T Pro, R… | Snapdragon 865 5G  | 2020-10-13   | U      |      200 |     0.005% |
| 554  | z3tc             | Sony           | Xperia Z3 Tablet Compact  | Snapdragon 801     | 2014-11-01   | U      |      198 |     0.005% |
| 554  | elish            | Xiaomi         | Pad 5 Pro Wi-Fi           | Snapdragon 870 5G  | 2021-08-10   | U      |      198 |     0.005% |
| 554  | beethoven        | Huawei         | Mediapad M3 8.4           | Kirin 950          | 2016-10-01   | U      |      198 |     0.005% |
| 557  | tundra           | Motorola       | edge 30 fusion            | Snapdragon 888+    | 2022-09-01   | O      |      196 |     0.005% |
| 557  | gvwifi           | Samsung        | Galaxy View WiFi (SM-T67… | Exynos 7580 Octa   | 2015-11-01   | U      |      196 |     0.005% |
| 559  | venus            | Xiaomi         | Mi 11                     | Snapdragon 888 5G  | 2021-01-01   | U      |      193 |     0.005% |
| 559  | tanzanite        | Xiaomi         | Redmi Note 14 4G          | Helio G99 Ultra    | 2025-01-15   | U      |      193 |     0.005% |
| 559  | mako             | Google         | Nexus 4                   | Snapdragon S4 Pro  | 2012-11-13   | D      |      193 |     0.005% |
| 559  | capri            | Motorola       | moto g10, moto g10 power… | Snapdragon 460     | 2021-02-01   | O      |      193 |     0.005% |
| 563  | NB1              | Nokia          | Nokia 8                   | Snapdragon 835     | 2017-08-16   | O      |      192 |     0.005% |
| 564  | thyme            | Xiaomi         | Mi 10S                    | Snapdragon 870     | 2021-03-01   | O      |      191 |     0.004% |
| 565  | erhai            | OnePlus        | OnePlus Pad 2 Pro, OnePl… | Snapdragon 8 Elite | 2025-05-01   | O      |      189 |     0.004% |
| 565  | btvdl09          | Huawei         | Mediapad M3 8.4 (BTV-DL0… | Kirin 950          | 2016-10-01   | U      |      189 |     0.004% |
| 567  | socrates         | Xiaomi         | Redmi K60 Pro             | Snapdragon 8 Gen2  | 2022-12-27   | O      |      186 |     0.004% |
| 567  | X00T             | ASUS           | Zenfone Max Pro M1        | Snapdragon 636     | 2018-05-01   | U      |      186 |     0.004% |
| 569  | z3c              | Sony           | Xperia Z3 Compact         | Snapdragon 801     | 2014-09-04   | D      |      185 |     0.004% |
| 570  | nabu             | Xiaomi         | Pad 5                     | Snapdragon 860     | 2021-08-10   | U      |      184 |     0.004% |
| 570  | js01lte          | Samsung        | Galaxy J (Docomo SC-02F)  | Snapdragon 800     | 2013-12-01   | U      |      184 |     0.004% |
| 570  | honami           | Sony           | Xperia Z1 (C6903)         | Snapdragon 800     | 2013-09-01   | U      |      184 |     0.004% |
| 573  | tapas            | Xiaomi         | Redmi Note 12 4G          | Snapdragon 685     | 2023-03-30   | U      |      183 |     0.004% |
| 573  | rodin            | Xiaomi         | Poco X7 Pro               | Dimensity 8400 Ul… | 2025-01-09   | U      |      183 |     0.004% |
| 575  | giulia           | OnePlus        | 13R, Ace 5                | Snapdragon 8 Gen 3 | 2025-01-14   | U      |      182 |     0.004% |
| 575  | curtana          | Xiaomi         | Redmi Note 9S, Redmi Not… | Snapdragon 720G    | 2020-04-30   | U      |      182 |     0.004% |
| 577  | avalon           | OnePlus        | Nord 4                    | Snapdragon 7+ Gen… | 2024-07-01   | O      |      181 |     0.004% |
| 578  | cheryl           | Razer          | Phone                     | Snapdragon 835     | 2017-11-01   | O      |      180 |     0.004% |
| 578  | TB8703N          | Lenovo         | Tab3 8 plus               | Snapdragon 625     | 2017-03-01   | U      |      180 |     0.004% |
| 580  | quill            | NVIDIA         | Jetson TX2 [Android TV],… | Tegra X2 (T186)    | 2017-03-14   | O      |      179 |     0.004% |
| 580  | griffin          | Motorola       | moto z                    | Snapdragon 820     | 2016-09-01   | D      |      179 |     0.004% |
| 582  | z3s              | Samsung        | Galaxy S20 Ultra (5G)     | Exynos 990         | 2020-03-06   | O      |      178 |     0.004% |
| 582  | lux              | Motorola       | moto x play               | Snapdragon 615     | 2015-08-01   | D      |      178 |     0.004% |
| 582  | giza             | Amazon         | Fire HD 8 7/6th gen (KFG… | MediaTek MT8163V/B | 2016-09-21   | U      |      178 |     0.004% |
| 582  | btv              | Huawei         | Mediapad M3 8.4           | Kirin 950          | 2016-10-01   | U      |      178 |     0.004% |
| 582  | a505fn           | Samsung        | Galaxy A50 (SM-A505FN)    | Exynos 9610        | 2019-03-18   | U      |      178 |     0.004% |
| 587  | vermeer          | Xiaomi         | POCO F6 Pro, Redmi K70    | Snapdragon 8 Gen2  | 2023-11-29   | O      |      177 |     0.004% |
| 587  | r9s              | OPPO           | R9s                       | Snapdragon 625     | 2016-10-01   | U      |      177 |     0.004% |
| 589  | sweet2           | Xiaomi         | Redmi Note 12 Pro         | Dimensity 1080     | 2022-11-01   | U      |      176 |     0.004% |
| 589  | monet            | Xiaomi         | Mi 10 Lite 5G             | Snapdragon 765G    | 2020-05-01   | D      |      176 |     0.004% |
| 591  | tblte            | Samsung        | Galaxy Note Edge (SM-N91… | Snapdragon 805     | 2014-11-01   | U      |      175 |     0.004% |
| 591  | RMX1821          | Realme         | 3 (RMX1821)               | Helio P60          | 2019-03-01   | U      |      175 |     0.004% |
| 593  | poplar_dsds      | Sony           | Xperia XZ1 Dual (F8342)   | Snapdragon 835     | 2017-09-19   | U      |      174 |     0.004% |
| 593  | gts7l            | Samsung        | Galaxy Tab S7 (LTE)       | Snapdragon 865+    | 2020-08-21   | O      |      174 |     0.004% |
| 595  | j1acevelte       | Samsung        | Galaxy J1 Ace VE, Galaxy… | Spreadtrum SC9830  | 2016-07-11   | U      |      171 |     0.004% |
| 595  | X01BD            | ASUS           | Zenfone Max Pro M2        | Snapdragon 660     | 2018-12-01   | D      |      171 |     0.004% |
| 597  | vili             | Xiaomi         | 11T Pro                   | Snapdragon 888 5G  | 2021-10-05   | U      |      169 |     0.004% |
| 597  | chopin           | Xiaomi         | Redmi Note 10 PRO 5G      | Snapdragon 732G    | 2021-03-24   | U      |      169 |     0.004% |
| 599  | odin             | Sony           | Xperia ZL                 | Snapdragon S4 Pro  | 2013-03-01   | D      |      168 |     0.004% |
| 599  | mermaid          | Sony           | Xperia 10 Plus            | Snapdragon 636     | 2019-02-01   | O      |      168 |     0.004% |
| 601  | odroidc4         | HardKernel     | ODROID-C4 (Android TV)    | Amlogic S905X3     | 2020-12-01   | O      |      167 |     0.004% |
| 602  | tre3calteskt     | Samsung        | Galaxy Note 4 (N916S/L/K) | Exynos 5433        | 2014-10-01   | U      |      166 |     0.004% |
| 602  | i9305            | Samsung        | Galaxy S III (LTE / Inte… | Exynos 4412        | 2012-10-01   | D      |      166 |     0.004% |
| 604  | pme              | HTC            | HTC 10                    | Snapdragon 820     | 2016-05-01   | D      |      164 |     0.004% |
| 605  | sake             | ASUS           | ZenFone 8                 | Snapdragon 888     | 2021-05-01   | O      |      163 |     0.004% |
| 606  | r5x              | Realme         | 5, 5i, 5s, 5NFC           | Snapdragon 665 SD… | 2019-08-01   | U      |      161 |     0.004% |
| 607  | milanf           | Motorola       | moto g stylus 5G (2022)   | Snapdragon 695     | 2022-04-27   | O      |      160 |     0.004% |
| 607  | gt58ltebmc       | Samsung        | Galaxy Tab A 8.0 (SM-T35… | Snapdragon 410     | 2015-05-01   | U      |      160 |     0.004% |
| 607  | degaslte         | Samsung        | Galaxy Tab 4 7.0 LTE, Ga… | Exynos 3470 Quad   | 2014-05-01   | U      |      160 |     0.004% |
| 610  | odroidxu3        | HardKernel     | ODROID-XU3                | Exynos 5422        | 2014-08-18   | U      |      159 |     0.004% |
| 610  | courbet          | Xiaomi         | Mi 11 Lite 4G             | Snapdragon 732G    | 2021-04-16   | U      |      159 |     0.004% |
| 612  | pro1x            | F(x)tec        | Pro¹ X                    | Snapdragon 662     | 2022-12-01   | O      |      158 |     0.004% |
| 613  | crackling        | Wileyfox       | Swift                     | Snapdragon 410     | 2015-10-01   | D      |      156 |     0.004% |
| 614  | xaga             | Xiaomi         | POCO X4 GT                | Dimensity 8100     | 2022-06-27   | U      |      155 |     0.004% |
| 614  | vivalto3mveml3g  | Samsung        | Galaxy Ace 4 Neo (SM-G31… | Spreadtrum SC8830  | 2014-08-01   | U      |      155 |     0.004% |
| 616  | meliusltexx      | Samsung        | Galaxy Mega 6.3           | Snapdragon 400     | 2013-06-01   | U      |      154 |     0.004% |
| 617  | kagura           | Sony           | Xperia XZ Dual (F8332)    | Snapdragon 820     | 2016-10-03   | U      |      153 |     0.004% |
| 617  | a5ultexx         | Samsung        | Galaxy A5 (A500FU)        | Snapdragon 410     | 2014-12-01   | U      |      153 |     0.004% |
| 617  | a53x             | Samsung        | Galaxy A53 5G             | Exynos 1280 (5 nm) | 2022-03-24   | U      |      153 |     0.004% |
| 620  | victara          | Motorola       | moto x (2014)             | Snapdragon 801     | 2014-09-26   | D      |      152 |     0.004% |
| 620  | f62              | Samsung        | Galaxy F62, Galaxy M62    | Exynos 9825        | 2021-02-22   | O      |      152 |     0.004% |
| 622  | voyager          | Sony           | Xperia XA2 Plus           | Snapdragon 630     | 2018-07-01   | O      |      151 |     0.004% |
| 622  | hima             | HTC            | One M9                    | Snapdragon 810     | 2015-03-09   | U      |      151 |     0.004% |
| 622  | ariel            | Amazon         | Fire HD 6/7               | MediaTek MT8135V   | 2014-10-02   | U      |      151 |     0.004% |
| 625  | RMX1931          | Realme         | X2 Pro (RMX1931)          | Snapdragon 855+    | 2019-10-01   | U      |      148 |     0.003% |
| 626  | a05m             | Samsung        | A05 (SM-A055F/M)          | Helio G85 (12 nm)  | 2023-10-15   | U      |      147 |     0.003% |
| 627  | v500             | LG             | G Pad 8.3                 | Snapdragon 600     | 2013-10-14   | D      |      145 |     0.003% |
| 627  | j1xlte           | Samsung        | Galaxy J1 (2016) (SM-J12… | Spreadtrum SC9830  | 2016-01-01   | U      |      145 |     0.003% |
| 629  | ss2              | Sharp          | Aquos S2                  | Snapdragon 630 an… | 2017-08-01   | U      |      143 |     0.003% |
| 630  | nuwa             | Xiaomi         | Xiaomi 13 Pro             | Snapdragon 8 Gen2  | 2022-12-11   | O      |      141 |     0.003% |
| 630  | m21              | Samsung        | Galaxy M21                | Exynos 9611        | 2020-03-23   | U      |      141 |     0.003% |
| 630  | karate           | Lenovo         | K6 Power                  | Snapdragon 430     | 2016-11-01   | U      |      141 |     0.003% |
| 633  | j4corelte        | Samsung        | Galaxy J4+                | Snapdragon 425     | 2018-10-01   | U      |      140 |     0.003% |
| 633  | RMX2020          | Realme         | C3                        | Helio G70          | 2020-02-14   | U      |      140 |     0.003% |
| 635  | hannah           | Motorola       | moto e5 plus (XT1924-6/7… | Snapdragon 435     | 2018-05-01   | D      |      139 |     0.003% |
| 636  | flounder         | Google         | Nexus 9 (Wi-Fi)           | Tegra K1 (T124)    | 2014-11-03   | D      |      138 |     0.003% |
| 636  | FP6              | Fairphone      | 6                         | Snapdragon 7s Gen… | 2025-06-25   | U      |      138 |     0.003% |
| 638  | satsuki          | Sony           | Xperia Z5 Premium         | Snapdragon 810     | 2015-11-05   | U      |      136 |     0.003% |
| 638  | pdx237           | Sony           | Xperia 5 V                | Snapdragon 8 Gen2  | 2023-09-01   | O      |      136 |     0.003% |
| 640  | B2N              | Nokia          | Nokia 7 plus              | Snapdragon 660     | 2018-04-30   | O      |      135 |     0.003% |
| 641  | n7000            | Samsung        | Galaxy Note N7000         | Exynos 4210 Dual   | 2011-10-01   | U      |      134 |     0.003% |
| 642  | albus            | Motorola       | moto z2 play              | Snapdragon 626     | 2017-06-01   | D      |      133 |     0.003% |
| 643  | foster_tab       | NVIDIA         | Shield TV (2015 / 2015 P… | Tegra X1 (T210)    | 2015-05-28   | O      |      132 |     0.003% |
| 644  | viva             | Xiaomi         | Redmi Note 11 Pro 4G      | Helio G96          | 2022-02-18   | U      |      131 |     0.003% |
| 645  | x86_64_tablet    |                |                           | x86_64             |              | U      |      130 |     0.003% |
| 645  | h850             | LG             | G5 (International)        | Snapdragon 820     | 2016-02-01   | D      |      130 |     0.003% |
| 647  | o1s              | Samsung        | Galaxy S21 5G (SM-G991B/… | Exynos 2100        | 2021-01-29   | U      |      129 |     0.003% |
| 647  | kltekdi          | Samsung        | Galaxy S5 LTE (SC-04F/SC… | Snapdragon 801     | 2014-05-01   | D      |      129 |     0.003% |
| 647  | ham              | ZUK            | Z1                        | Snapdragon 801     | 2015-10-14   | D      |      129 |     0.003% |
| 647  | dm3q             | Samsung        | Galaxy S23 Ultra          | Snapdragon 8 Gen 2 | 2023-02-17   | U      |      129 |     0.003% |
| 647  | RMP6768          | Realme         | Pad                       | Helio G80          | 2021-09-16   | U      |      129 |     0.003% |
| 652  | yuga             | Sony           | Xperia Z                  | Snapdragon S4 Pro  | 2013-02-01   | D      |      128 |     0.003% |
| 652  | p3s              | Samsung        | Galaxy S21 Ultra 5G (SM-… | Exynos 2100        | 2021-01-29   | U      |      128 |     0.003% |
| 652  | a21snsxx         | Samsung        | Galaxy A21s               | Exynos 850 (8 nm)  | 2020-06-02   | U      |      128 |     0.003% |
| 655  | marmite          | Wileyfox       | Swift 2, Swift 2 Plus, S… | Snapdragon 430     | 2016-11-01   | U      |      126 |     0.003% |
| 655  | dopinder         | Walmart        | onn. TV Box 4K (2021)     | Amlogic S905Y2     | 2021-06-01   | O      |      126 |     0.003% |
| 655  | denver           | Motorola       | moto g stylus 5G          | Snapdragon 480     | 2021-06-14   | O      |      126 |     0.003% |
| 655  | a32              | Samsung        | Galaxy A32 4G             | Helio G80 (12 nm)  | 2021-02-25   | U      |      126 |     0.003% |
| 659  | jactivelte       | Samsung        | Galaxy S4 Active          | Snapdragon 600     | 2013-06-01   | D      |      125 |     0.003% |
| 660  | TBX304F          | Lenovo         | Tab4 10 WiFi (TB-X304F)   | Qualcomm APQ8017   | 2017-07-01   | U      |      124 |     0.003% |
| 661  | P350             | Samsung        | Galaxy Tab A 8" with S P… | Snapdragon 410     | 2015-05-01   | U      |      123 |     0.003% |
| 662  | yunluo           | Xiaomi         | Redmi Pad                 | Helio G99          | 2022-10-05   | U      |      120 |     0.003% |
| 663  | tb128fu          | Lenovo         | Xiaoxin Pad 2022 (TB128F… | Snapdragon 680     | 2022-05-01   | U      |      119 |     0.003% |
| 664  | n5120            | Samsung        | Galaxy Note 8.0 (LTE)     | Exynos 4412        | 2013-04-01   | D      |      118 |     0.003% |
| 664  | fire             | Xiaomi         | Redmi 12                  | Helio G88 MT6769H… | 2023-06-15   | U      |      118 |     0.003% |
| 666  | ursa             | Xiaomi         | Mi 8 Explorer Edition     | Snapdragon 845     | 2018-07-01   | O      |      117 |     0.003% |
| 666  | gta2swifi        | Samsung        | Galaxy Tab A WiFi (SM-T3… | Snapdragon 425     | 2017-09-01   | U      |      117 |     0.003% |
| 666  | f310p            | FEITIAN        | F310 Smart Financial Ter… |                    | 2022-08-13   | U      |      117 |     0.003% |
| 669  | bahamut          | Sony           | Xperia 1, Xperia 5        | Snapdragon 855     | 2019-05-30   | U      |      116 |     0.003% |
| 669  | RMX1941          | Realme         | C2                        | Helio P22          | 2019-05-01   | U      |      116 |     0.003% |
| 671  | q5q              | Samsung        | Galaxy Z Fold 5           | Snapdragon 8 Gen 2 | 2023-08-11   | U      |      115 |     0.003% |
| 671  | nx659j           | Nubia          | Red Magic 5G (Global), R… | Snapdragon 865     | 2020-03-01   | O      |      115 |     0.003% |
| 671  | ja3gxx           | Samsung        | Galaxy S4 (I9500)         | Exynos 5410 Octa   | 2013-04-01   | U      |      115 |     0.003% |
| 671  | Z1               |                |                           |                    |              | U      |      115 |     0.003% |
| 675  | heart            | Lenovo         | Z5 Pro GT                 | Snapdragon 855     | 2019-01-29   | O      |      114 |     0.003% |
| 675  | bouquet          | Xiaomi         | Redmi Note 6 Pro          | Snapdragon 636     | 2018-10-01   | U      |      114 |     0.003% |
| 677  | lt02ltespr       | Samsung        | Galaxy Tab 3 7.0 LTE      | Snapdragon 400     | 2016-09-01   | D      |      113 |     0.003% |
| 677  | Pacman           | Nothing        | Phone (2a)                | Dimensity 7200 Pro | 2024-03-12   | U      |      113 |     0.003% |
| 679  | redwood          | Xiaomi         | Poco X5 Pro               | Snapdragon 778G 5G | 2023-02-07   | U      |      112 |     0.003% |
| 679  | debx             | Google         | Nexus 7 2013 (LTE, Repar… | Snapdragon S4 Pro  | 2013-07-26   | D      |      112 |     0.003% |
| 679  | a54x             | Samsung        | Galaxy A54 5G             | Exynos 1380        | 2023-03-24   | U      |      112 |     0.003% |
| 682  | h990             | LG             | V20 (Global)              | Snapdragon 820     | 2016-10-01   | D      |      111 |     0.003% |
| 683  | unicorn          | Xiaomi         | Xiaomi 12S Pro            | Snapdragon 8+ Gen1 | 2022-07-04   | O      |      110 |     0.003% |
| 683  | toco             | Xiaomi         | Mi Note 10 Lite           | Snapdragon 730G    | 2020-05-09   | U      |      110 |     0.003% |
| 683  | a3ltexx          | Samsung        | Galaxy A3 (A300F)         | Snapdragon 410     | 2014-12-01   | U      |      110 |     0.003% |
| 686  | shark            | Xiaomi         | Black Shark               | Snapdragon 845     | 2018-04-01   | O      |      109 |     0.003% |
| 686  | bronco           | Motorola       | ThinkPhone by motorola    | Snapdragon 8+ Gen1 | 2023-01-01   | O      |      109 |     0.003% |
| 686  | b5q              | Samsung        | Galaxy Z Flip 5           | Snapdragon 8 Gen 2 | 2023-08-11   | U      |      109 |     0.003% |
| 689  | trhpltexx        | Samsung        | Galaxy Note 4 (N910U)     | Exynos 5 Octa 5433 | 2014-10-01   | U      |      108 |     0.003% |
| 689  | felix            | Google         | Pixel Fold                | Tensor GS201       | 2023-06-27   | O      |      108 |     0.003% |
| 689  | beyond1          | Samsung        | Galaxy S10                | Exynos 9820        | 2019-03-08   | U      |      108 |     0.003% |
| 689  | RMX2001L1        | Realme         | 6, 6i (India), 6s, Narzo  | Helio G90T         | 2020-03-11   | U      |      108 |     0.003% |
| 693  | fortunave3g      | Samsung        | Galaxy Grand Prime (SM-G… | Snapdragon 410     | 2014-10-01   | U      |      107 |     0.003% |
| 694  | trlteduos        | Samsung        | Galaxy Note 4             | Snapdragon 805     | 2014-10-01   | U      |      106 |     0.002% |
| 694  | tetris           | Nothing        | CMF Phone 1               | Dimensity 7300     | 2024-07-09   | U      |      106 |     0.002% |
| 694  | kccat6           | Samsung        | Galaxy S5 Plus            | Snapdragon 805     | 2014-08-21   | D      |      106 |     0.002% |
| 694  | ingot            | Solana         | Saga                      | Snapdragon 8+ Gen1 | 2023-05-01   | O      |      106 |     0.002% |
| 694  | b2q              | Samsung        | Galaxy Z Flip3 5G         | Snapdragon 888 5G  | 2021-08-27   | U      |      106 |     0.002% |
| 699  | xdplus           | GPD            | XD Plus                   | MediaTek MT8176    | 2018-04-01   | U      |      105 |     0.002% |
| 699  | waydroid_kvadra… | virtual        | Waydroid                  | ARM64              |              | U      |      105 |     0.002% |
| 699  | RMX1851          | Realme         | Realme 3 Pro              | Snapdragon 710     | 2019-04-29   | D      |      105 |     0.002% |
| 702  | rock             | Iocean         | Rock MT6752               | MediaTek MT6752    |              | U      |      104 |     0.002% |
| 702  | realme_trinket   | Realme         | 5, 5i, 5s, 5 NFC, 5 Viet… | Snapdragon 665     | 2019-08-01   | U      |      104 |     0.002% |
| 702  | peregrine        | Motorola       | moto g 4G                 | Snapdragon 400     | 2014-06-01   | D      |      104 |     0.002% |
| 702  | g710n            | LG             | G7 ThinQ (G710N)          | Snapdragon 845     | 2018-05-02   | O      |      104 |     0.002% |
| 702  | a04e             | Samsung        | Galaxy A04e               | Helio P35          | 2022-11-07   | U      |      104 |     0.002% |
| 707  | p10bio           |                |                           |                    |              | U      |      103 |     0.002% |
| 707  | gracelte         | Samsung        | Note 7 (SM-N930F)         | Exynos 8890 Octa   | 2016-09-01   | U      |      103 |     0.002% |
| 709  | r7               | OPPO           | R7                        | Snapdragon 615     | 2015-05-01   | U      |      102 |     0.002% |
| 709  | afyonltecan      | Samsung        | Galaxy Core LTE           | Snapdragon 400     | 2014-05-01   | U      |      102 |     0.002% |
| 711  | m1971            | Meizu          | 16s                       | Snapdragon 855     | 2019-04-01   | U      |      101 |     0.002% |
| 711  | gts7xlwifi       | Samsung        | Galaxy Tab S7+ Wifi       | Snapdragon 865 5G+ | 2020-08-21   | U      |      101 |     0.002% |
| 713  | karin_windy      | Sony           | Xperia Z4 Tablet WiFi     | Snapdragon 810     | 2015-10-01   | D      |       99 |     0.002% |
| 713  | btvw09           | Huawei         | Mediapad M3 8.4 (BTV-W09… | Kirin 950          | 2016-10-01   | U      |       99 |     0.002% |
| 713  | a42xq            | Samsung        | Galaxy A42 5G             | Snapdragon 750 5G  | 2020-11-11   | U      |       99 |     0.002% |
| 713  | Onyx             | OnePlus        | X                         | Snapdragon 801     | 2015-10-29   | U      |       99 |     0.002% |
| 717  | s3ve3g           | Samsung        | Galaxy S3 Neo             | Snapdragon 400     | 2014-04-01   | U      |       98 |     0.002% |
| 718  | tank             | Amazon         | Fire TV Stick (2nd gen)   | MediaTek MT8127D   | 2016-10-20   | U      |       97 |     0.002% |
| 718  | h918             | LG             | V20 (T-Mobile)            | Snapdragon 820     | 2016-10-01   | D      |       97 |     0.002% |
| 718  | h870             | LG             | G6 (EU Unlocked)          | Snapdragon 821     | 2017-02-01   | D      |       97 |     0.002% |
| 718  | dandelion        | Xiaomi         | Redmi 9A                  | Helio G25          | 2020-07-07   | U      |       97 |     0.002% |
| 722  | x6833b           | Infinix        | Infinix NOTE 30           | Helio G99          | 2023-05-01   | U      |       95 |     0.002% |
| 722  | a03s             | Samsung        | Galaxy A03s               | Helio P35          | 2021-08-18   | U      |       95 |     0.002% |
| 722  | A10-70L          | Lenovo         | Tab 2 LTE (A10-70L)       | Mediatek MT8732    | 2015-04-01   | U      |       95 |     0.002% |
| 725  | q2q              | Samsung        | Galaxy Z Fold3 5G         | Snapdragon 888 5G… | 2021-08-27   | U      |       94 |     0.002% |
| 725  | m5               | Banana Pi      | M5 (Android TV)           | Amlogic S905X3     | 2020-12-01   | O      |       94 |     0.002% |
| 725  | e3q              | Samsung        | Galaxy S24 Ultra          | Snapdragon 8 Gen 3 | 2024-01-24   | U      |       94 |     0.002% |
| 728  | gt58lte          | Samsung        | Galaxy Tab A 8.0 (SM-T35… | Snapdragon 410     | 2015-05-01   | U      |       93 |     0.002% |
| 728  | goyavewifi       | Samsung        | Galaxy Tab E 7” (SM-T113… | Spreadtrum SC8830  | 2015-03-01   | U      |       93 |     0.002% |
| 728  | a34x             | Samsung        | Galaxy A34 5G             | Dimensity 1080     | 2023-03-24   | U      |       93 |     0.002% |
| 731  | aurora           | Sony           | Xperia XZ2 Premium        | Snapdragon 845     | 2018-04-01   | O      |       92 |     0.002% |
| 731  | ares             | Xiaomi         | POCO X4 GT, Redmi Note 1… | Dimensity 8100     | 2022-05-31   | U      |       92 |     0.002% |
| 733  | oscar            | Realme         | Realme 9 Pro 5G, Realme … | Snapdragon 695     | 2022-02-23   | O      |       91 |     0.002% |
| 733  | kansas           | Motorola       | moto g (2025)             | Dimensity 6300 (6… | 2025-01-30   | U      |       91 |     0.002% |
| 733  | dora             | Sony           | Xperia X Performance      | Snapdragon 820     | 2016-07-01   | U      |       91 |     0.002% |
| 733  | berlna           | Motorola       | edge 2021                 | Snapdragon 778G 5G | 2021-08-19   | O      |       91 |     0.002% |
| 733  | b0q              | Samsung        | Galaxy S22 Ultra          | Snapdragon 8 Gen 1 | 2022-02-25   | U      |       91 |     0.002% |
| 733  | X6531            | Infinix        | Hot 50i                   | Helio G81          | 2024-10-01   | U      |       91 |     0.002% |
| 739  | odroidm1         | HardKernel     | ODROID-M1                 | Rockchip RK3568B2  | 2022-04-03   | U      |       90 |     0.002% |
| 739  | nashc            | Realme         | 8                         | Helio G95          | 2021-03-25   | U      |       90 |     0.002% |
| 739  | mayfly           | Xiaomi         | Xiaomi 12S                | Snapdragon 8+ Gen1 | 2022-07-01   | O      |       90 |     0.002% |
| 742  | treble           |                |                           |                    |              | U      |       89 |     0.002% |
| 742  | t2s              | Samsung        | Galaxy S21+ 5G (SM-G996B… | Exynos 2100 (5 nm) | 2021-01-29   | U      |       89 |     0.002% |
| 742  | karatep          | Lenovo         | K6 Note, K6 Plus          | Snapdragon 430     | 2016-12-01   | U      |       89 |     0.002% |
| 745  | g710ulm          | LG             | G7 ThinQ (G710ULM/VMX)    | Snapdragon 845     | 2018-05-02   | O      |       88 |     0.002% |
| 745  | axolotl          | SHIFT          | SHIFT6mq                  | Snapdragon 845     | 2020-06-01   | O      |       88 |     0.002% |
| 747  | lt01lte          | Samsung        | Galaxy Tab 3 (SM-T315)    | Exynos 4212 Dual   | 2013-07-01   | U      |       87 |     0.002% |
| 747  | icosa_sr         | Nintendo       | Switch                    | Tegra X1           | 2017-03-03   | U      |       87 |     0.002% |
| 749  | a10dd            | Samsung        | A10                       | Exynos 7884        | 2019-03-19   | U      |       86 |     0.002% |
| 749  | Crystal          | Nokia          | 7.1                       | Snapdragon 636     | 2018-10-28   | U      |       86 |     0.002% |
| 751  | huashan          | Sony           | Xperia SP                 | Snapdragon S4 Pro  | 2013-04-01   | D      |       85 |     0.002% |
| 751  | caihong          | OnePlus        | Pad Pro, Pad 2            | Snapdragon 8 Gen3  | 2024-06-29   | O      |       85 |     0.002% |
| 753  | sphynx           | Google         | Pixel C                   | Nvidia Tegra X1    | 2015-12-08   | U      |       84 |     0.002% |
| 753  | r9q              | Samsung        | Galaxy S21 FE 5G          | Snapdragon 888 5G  | 2022-01-07   | U      |       84 |     0.002% |
| 753  | h910             | LG             | V20 (AT&T)                | Snapdragon 820     | 2016-10-01   | D      |       84 |     0.002% |
| 756  | waydroid_arm     | virtual        | Waydroid on ARM           | ARM32              |              | U      |       83 |     0.002% |
| 756  | samurai          | Realme         | X2 Pro (RMX1931)          | Snapdragon 855+    | 2019-10-01   | U      |       83 |     0.002% |
| 758  | scorpio          | Xiaomi         | Mi Note 2                 | Snapdragon 821     | 2016-11-01   | D      |       82 |     0.002% |
| 759  | r11s             | OPPO           | R11                       | Snapdragon 660     | 2017-06-01   | U      |       81 |     0.002% |
| 759  | pdx201           | Sony           | Xperia 10 II              | Snapdragon 665     | 2020-05-05   | U      |       81 |     0.002% |
| 761  | casuarina        | Vsmart         | Joy 3, Joy 3+             | Snapdragon 632     | 2020-02-14   | O      |       80 |     0.002% |
| 761  | X01AD            | ASUS           | Zenfone Max M2            | Snapdragon 632     | 2018-12-01   | D      |       80 |     0.002% |
| 763  | mojito           | Xiaomi         | Redmi Note 10             | Snapdragon 678     | 2021-03-16   | U      |       79 |     0.002% |
| 763  | m31s             | Samsung        | Galaxy M31s               | Exynos 9611        | 2020-08-06   | U      |       79 |     0.002% |
| 763  | i9152            | Samsung        | Galaxy Mega 5.8 Duos (I9… | Broadcom BCM28155  | 2013-05-01   | U      |       79 |     0.002% |
| 763  | eqs              | Motorola       | edge 30 ultra             | Snapdragon 8+ Gen1 | 2022-09-01   | O      |       79 |     0.002% |
| 763  | X6833B           | Infinix        | Note 30 (X6833B)          | Helio G99          | 2023-05-22   | U      |       79 |     0.002% |
| 768  | x55              | PowKiddy       | X55                       | Rockchip RK3566    | 2023-05-01   | U      |       78 |     0.002% |
| 768  | wt88047x         | Xiaomi         | Redmi 2                   | Snapdragon 410     | 2015-01-01   | U      |       78 |     0.002% |
| 768  | o7prolte         | Samsung        | Galaxy On7                | Snapdragon 410     | 2015-11-01   | U      |       78 |     0.002% |
| 768  | lime             | Xiaomi         | Redmi 9T, Redmi 9T NFC, … | Snapdragon 662     | 2021-01-18   | U      |       78 |     0.002% |
| 768  | asteroids        | Nothing        | Phone (3a)                | Snapdragon 7s Gen… | 2025-03-11   | U      |       78 |     0.002% |
| 773  | nikel            | Xiaomi         | Redmi Note 4              | Snapdragon 625     | 2017-01-01   | U      |       77 |     0.002% |
| 773  | lithium          | Xiaomi         | Mi MIX                    | Snapdragon 821     | 2016-10-01   | D      |       77 |     0.002% |
| 773  | chuwi_vi10plus   | Chuwi          | Vi10 Plus, Hi10 Plus, Hi… | Atom X5 Z8350      | 2016-10-02   | U      |       77 |     0.002% |
| 776  | odessa           | Motorola       | Moto G9 Plus              | Snapdragon 730G    | 2020-09-07   | U      |       76 |     0.002% |
| 776  | nora             | Motorola       | Moto E5, Moto E (5th Gen… | Snapdragon 425     | 2018-05-01   | U      |       76 |     0.002% |
| 776  | i9105p           | Samsung        | Galaxy S II Plus (I9105)  | Broadcom BC28155   | 2013-02-01   | U      |       76 |     0.002% |
| 776  | citrus           | Xiaomi         | POCO M3                   | Snapdragon 662     | 2020-11-27   | U      |       76 |     0.002% |
| 776  | a13              | Samsung        | A13                       | Exynos 850 (8 nm)  | 2022-03-23   | U      |       76 |     0.002% |
| 776  | P024             | ASUS           | ZenPad 8.0 (Z380KL)       | Snapdragon 410     | 2015-07-01   | D      |       76 |     0.002% |
| 782  | porg             | NVIDIA         | Jetson Nano [Android TV]… | Tegra X1 (T210)    | 2019-03-18   | O      |       75 |     0.002% |
| 783  | wade             | Dynalink       | TV Box 4K (2021)          | Amlogic S905Y2     | 2021-06-01   | O      |       74 |     0.002% |
| 783  | RMX1971          | Realme         | 5 Pro, Q                  | Snapdragon 712     | 2019-09-01   | U      |       74 |     0.002% |
| 785  | p6800            | Samsung        | Galaxy Tab 7.7 (P6800)    | Exynos 4 Dual 4210 | 2011-12-01   | U      |       73 |     0.002% |
| 785  | axon7            | ZTE            | Axon 7                    | Snapdragon 820     | 2016-06-01   | D      |       73 |     0.002% |
| 785  | a20e             | Samsung        | Galaxy A20e               | Exynos 7884        | 2019-05-01   | U      |       73 |     0.002% |
| 785  | X6739            | Infinix        | GT 10 Pro                 | Dimensity 8050     | 2023-08-13   | U      |       73 |     0.002% |
| 789  | nx595j           | Nubia          | Z17                       | Snapdragon 835     | 2017-06-01   | U      |       72 |     0.002% |
| 789  | everpal          | Xiaomi         | Redmi Note 11T, Redmi 11… | Dimensity 810      | 2021-12-07   | U      |       72 |     0.002% |
| 789  | ether            | Nextbit        | Robin                     | Snapdragon 808     | 2016-02-01   | D      |       72 |     0.002% |
| 792  | olives           | Xiaomi         | Redmi 8, Redmi 8A, Redmi… | Snapdragon 439     | 2019-10-12   | U      |       71 |     0.002% |
| 792  | jd2019           | Lenovo         | Z5s                       | Snapdragon 710     | 2018-12-24   | U      |       71 |     0.002% |
| 792  | a6plte           | Samsung        | Galaxy A6+ (2018)         | Snapdragon 450     | 2018-05-01   | U      |       71 |     0.002% |
| 795  | tegu             | Google         | Pixel 9a                  | Tensor G4          | 2025-04-10   | O      |       70 |     0.002% |
| 795  | m307f            | Samsung        | Galaxy M30s               | Exynos 9611        | 2019-10-30   | U      |       70 |     0.002% |
| 795  | judyp            | LG             | V35 ThinQ                 | Snapdragon 845     | 2018-05-30   | O      |       70 |     0.002% |
| 795  | a23              | Samsung        | Galaxy A23                | Snapdragon 680 4G  | 2022-03-25   | U      |       70 |     0.002% |
| 799  | nobleltejv       | Samsung        | Galaxy Note 5 (SM-N920C)  | Exynos 7420 Octa   | 2015-09-01   | U      |       69 |     0.002% |
| 799  | mars             | Xiaomi         | Mi 11 Pro                 | Snapdragon 888     | 2021-03-01   | D      |       69 |     0.002% |
| 799  | j23g             | Samsung        | Galaxy J2 (SM-J200H)      | Exynos 3475 Quad   | 2015-09-01   | U      |       69 |     0.002% |
| 799  | gprimeltexx      | Samsung        | Galaxy Grand Prime (G530… | Snapdragon 410     | 2014-10-01   | U      |       69 |     0.002% |
| 799  | Dragon           | Google         | Pixel C                   | Nvidia Tegra X1    | 2015-12-08   | U      |       69 |     0.002% |
| 799  | Daredevil        | Nokia          | 7.2                       | Snapdragon 660     | 2019-09-23   | U      |       69 |     0.002% |
| 805  | zippo            | Lenovo         | Z6 Pro                    | Snapdragon 855     | 2019-09-11   | O      |       68 |     0.002% |
| 805  | oxford           | Smartisan      | U3 Pro SE                 | Snapdragon 636     | 2018-05-01   | U      |       68 |     0.002% |
| 807  | wt89536          | YU             | Yureka 2                  | Snapdragon 625     | 2017-09-01   | U      |       67 |     0.002% |
| 807  | nx611j           | Nubia          | Z18 Mini                  | Snapdragon 660     | 2018-04-01   | D      |       67 |     0.002% |
| 807  | kyleprods        | Samsung        | Galaxy S Duos 2 (S7582)   | Broadcom BCM21664T | 2013-12-01   | U      |       67 |     0.002% |
| 807  | g0q              | Samsung        | Galaxy S22 (SM-S9060)     | Snapdragon 8 Gen 1 | 2022-02-25   | U      |       67 |     0.002% |
| 807  | benz             | OnePlus        | OnePlus Nord CE4          | Snapdragon 7 Gen 3 | 2024-04-01   | O      |       67 |     0.002% |
| 812  | gale             | Xiaomi         | Redmi 13C (4G), Poco C65  | Helio G85          | 2023-11-10   | U      |       66 |     0.002% |
| 812  | amogus_doha      | Motorola       | Moto G8 Plus              | Snapdragon 665     | 2019-10-28   | U      |       66 |     0.002% |
| 812  | GM9PRO_sprout    | General Mobile | GM9 Pro                   | Snapdragon 660     | 2018-09-01   | U      |       66 |     0.002% |
| 815  | klteactivexx     | Samsung        | Galaxy S5 Active (G870F)  | Snapdragon 801     | 2014-12-01   | D      |       65 |     0.002% |
| 815  | h830             | LG             | G5 (T-Mobile)             | Snapdragon 820     | 2016-02-01   | D      |       65 |     0.002% |
| 815  | bitra            | Realme         | GT Neo 2                  | Snapdragon 870 5G  | 2021-09-28   | U      |       65 |     0.002% |
| 815  | a32x             | Samsung        | Galaxy A32 5G             | Dimensity 720      | 2021-01-22   | U      |       65 |     0.002% |
| 819  | sweet_k6a        | Xiaomi         | Redmi Note 12 Pro 4G      | Snapdragon 732G    | 2023-04-11   | U      |       64 |     0.002% |
| 819  | porg_tab         | NVIDIA         | Jetson Nano [Tablet], Je… | Tegra X1 (T210)    | 2019-03-18   | O      |       64 |     0.002% |
| 819  | olivelite        | Xiaomi         | Redmi 8A                  | Snapdragon 439     | 2019-09-30   | U      |       64 |     0.002% |
| 822  | y2q              | Samsung        | Galaxy S20+ 5G            | Snapdragon 865 5G  | 2020-03-06   | U      |       62 |     0.001% |
| 822  | on5ltetmo        | Samsung        | Galaxy On5 (SM-G550T)     | Exynos 3475 Quad   | 2015-11-01   | U      |       62 |     0.001% |
| 822  | nx551j           | Nubia          | M2                        | Snapdragon 625     | 2017-06-01   | U      |       62 |     0.001% |
| 822  | a50              | Samsung        | Galaxy A50                | Exynos 9610        | 2019-03-18   | U      |       62 |     0.001% |
| 822  | RMX1911          | Realme         | 5, 5i, 5s                 | Snapdragon 665     | 2019-09-01   | U      |       62 |     0.001% |
| 822  | A6020            | Lenovo         | Vibe K5, Vibe K5 Plus     | Snapdragon 415     | 2016-04-01   | D      |       62 |     0.001% |
| 828  | star2qltesq      | Samsung        | Galaxy S9+ USA (SM-G965U) | Snapdragon 845     | 2018-03-01   | U      |       61 |     0.001% |
| 828  | ghost            | Motorola       | moto x                    | Snapdragon S4 Pro  | 2013-08-23   | D      |       61 |     0.001% |
| 830  | j1mini3gxw       | Samsung        | Galaxy J1 mini 3G         | Spreadtrum SC8830  | 2016-03-01   | U      |       60 |     0.001% |
| 830  | h3gduoschn       | Samsung        | Galaxy Note 3  (SM-N9002) | Snapdragon 800     | 2013-09-01   | U      |       60 |     0.001% |
| 830  | a6000            | Lenovo         | A6000, A6000 Plus         | Snapdragon 410     | 2015-01-28   | U      |       60 |     0.001% |
| 830  | Z00xD            | ASUS           | Zenfone 2 Laser           | Snapdragon 410     | 2015-09-01   | U      |       60 |     0.001% |
| 830  | A001D            | ASUS           | ZenFone Max Shot, ZenFon… | Snapdragon SiP 1   | 2019-03-01   | U      |       60 |     0.001% |
| 835  | m51              | Samsung        | M51                       | Snapdragon 730G    | 2020-09-11   | U      |       59 |     0.001% |
| 835  | klimtdcm         | Samsung        | Galaxy Tab S 8.4 (SC-03G) | Snapdragon 800     | 2014-07-01   | U      |       59 |     0.001% |
| 835  | ferrari          | Xiaomi         | Mi 4i                     | Snapdragon 615     | 2015-04-01   | U      |       59 |     0.001% |
| 835  | corfur           | Motorola       | moto g71 5G               | Snapdragon 695 5G  | 2022-01-19   | U      |       59 |     0.001% |
| 835  | andromeda        | Xiaomi         | Mi Mix 3 5g               | Snapdragon 855     | 2019-05-01   | U      |       59 |     0.001% |
| 840  | ks01lte          | Samsung        | Galaxy S4 LTE-A (GT-I950… | Snapdragon 800     | 2013-10-01   | D      |       58 |     0.001% |
| 840  | gunnar           | OnePlus        | OnePlus Nord N20          | Snapdragon 695     | 2022-04-28   | O      |       58 |     0.001% |
| 840  | d1q              | Samsung        | Galaxy Note 10 (SM-N970U) | Snapdragon 855     | 2019-08-23   | U      |       58 |     0.001% |
| 840  | condor           | Motorola       | moto e                    | Snapdragon 200     | 2014-05-13   | D      |       58 |     0.001% |
| 844  | ruby             | Xiaomi         | Redmi Note 12 Pro 5G      | Dimensity 1080     | 2022-11-01   | U      |       57 |     0.001% |
| 844  | quark            | Motorola       | Moto Maxx, Moto Turbo, D… | Snapdragon 805 AP… | 2014-10-01   | U      |       57 |     0.001% |
| 844  | olive            | Xiaomi         | Redmi 8                   | Snapdragon 439     | 2019-10-12   | U      |       57 |     0.001% |
| 844  | clark            | Motorola       | moto x pure edition (201… | Snapdragon 808     | 2015-09-01   | D      |       57 |     0.001% |
| 844  | beyond1q         | Samsung        | Galaxy S10 (SM-G973U)     | Snapdragon 855     | 2019-03-08   | U      |       57 |     0.001% |
| 844  | RMX2030          | Realme         | 5i (RMX2030)              | Snapdragon 665     | 2020-01-01   | U      |       57 |     0.001% |
| 850  | r5q              | Samsung        | Galaxy S10 Lite           | Snapdragon 855     | 2020-02-03   | U      |       56 |     0.001% |
| 850  | a13x             | Samsung        | Galaxy A13 5G             | Dimensity 700 5G   | 2021-12-03   | U      |       56 |     0.001% |
| 852  | tate             | Amazon         | Kindle Fire HD 7" (2nd G… | OMAP 4460 HS       | 2012-09-14   | U      |       55 |     0.001% |
| 852  | nx569j           | Nubia          | Z17 Mini                  | Snapdragon 652 or… | 2017-04-01   | U      |       55 |     0.001% |
| 852  | j7eltexx         | Samsung        | Galaxy J7 (2015) (SM-J70… | Exynos 7580        | 2015-07-16   | U      |       55 |     0.001% |
| 852  | comet            | Google         | Pixel 9 Pro Fold          | Tensor G4          | 2024-09-04   | O      |       55 |     0.001% |
| 852  | a22x             | Samsung        | Galaxy A22 5G             | Dimensity 700      | 2021-06-24   | U      |       55 |     0.001% |
| 852  | X6532            | Infinix        | SMART 9 (X6532)           | Helio G81          | 2024-10-01   | U      |       55 |     0.001% |
| 852  | PNX_sprout       | Nokia          | 8.1, X7                   | Snapdragon 710     | 2018-12-05   | U      |       55 |     0.001% |
| 859  | zorn             | Xiaomi         | Redmi K80, POCO F7 Pro    | Snapdragon 8 Gen 3 | 2024-11-27   | U      |       54 |     0.001% |
| 859  | picasso          | Xiaomi         | Redmi K30 5G              | Snapdragon 765G 5G | 2020-01-07   | U      |       54 |     0.001% |
| 859  | perry            | Motorola       | Moto E4 (US model)        | Snapdragon 427     | 2017-06-01   | U      |       54 |     0.001% |
| 859  | lunaa            | Realme         | GT Master Edition         | Snapdragon 778G 5G | 2021-07-30   | U      |       54 |     0.001% |
| 859  | liber            | Motorola       | one fusion+, one fusion+… | Snapdragon 730     | 2020-06-01   | D      |       54 |     0.001% |
| 859  | kingdom          | Lenovo         | Vibe Z2 Pro               | Snapdragon 801     | 2014-09-01   | D      |       54 |     0.001% |
| 859  | james            | Motorola       | Moto E5 Play, Moto E Pla… | Snapdragon 425 or… | 2018-07-01   | U      |       54 |     0.001% |
| 859  | beyond0          | Samsung        | Galaxy S10e               | Exynos 9820        | 2019-03-08   | U      |       54 |     0.001% |
| 859  | beryl            | Xiaomi         | POCO M7 Pro 5G            | Dimensity 7025 Ul… | 2024-12-20   | U      |       54 |     0.001% |
| 868  | r1q              | Samsung        | Galaxy A80                | Snapdragon 730     | 2019-05-01   | U      |       52 |     0.001% |
| 868  | kmini3g          | Samsung        | Galaxy S5 mini Duos       | Snapdragon 400     | 2014-08-01   | U      |       52 |     0.001% |
| 868  | f300             | LG             | Vu 3 F300L                | Snapdragon 800     | 2013-10-01   | U      |       52 |     0.001% |
| 868  | aio_otfp         | Lenovo         | Vibe K3 Note              | Mediatek MT6752    | 2015-03-01   | U      |       52 |     0.001% |
| 868  | a30s             | Samsung        | Galaxy A30                | Exynos 7904        | 2019-09-11   | U      |       52 |     0.001% |
| 873  | pro1             | F(x)tec        | Pro¹                      | Snapdragon 835     | 2019-10-01   | O      |       51 |     0.001% |
| 873  | pearl            | Xiaomi         | Redmi Note 12T Pro, Redm… | Dimensity 8200 Ul… | 2023-06-01   | U      |       51 |     0.001% |
| 873  | malachite        | Xiaomi         | Redmi Note 14 Pro 5G, PO… | Dimensity 7300 Ul… | 2025-01-15   | U      |       51 |     0.001% |
| 873  | maguro           | Google         | Galaxy Nexus GSM          | OMAP 4460          | 2011-10-01   | D      |       51 |     0.001% |
| 873  | cuscoi           | Motorola       | Moto g96 5G, Moto Edge 5… | Snapdragon 7s Gen… | 2024-05-15   | U      |       51 |     0.001% |
| 873  | alice            | Huawei         | P8 Lite (ALE-L21)         | Kirin 620          | 2015-05-01   | U      |       51 |     0.001% |
| 873  | a9y18qlte        | Samsung        | Galaxy A9 (2018) (SM-A92… | Snapdragon 660     | 2018-11-01   | U      |       51 |     0.001% |
| 873  | RMX2151L1        | Realme         | 7 (Asia - RMX2151L1)      | Helio G95          | 2020-09-10   | U      |       51 |     0.001% |
| 881  | tiare            | Xiaomi         | Redmi GO                  | Snapdragon 425     | 2019-02-01   | U      |       50 |     0.001% |
| 881  | jfltespr         | Samsung        | Galaxy S4 (SCH-R970, SPH… | Snapdragon 600     | 2013-04-01   | D      |       50 |     0.001% |
| 881  | enzo             |                |                           |                    |              | U      |       50 |     0.001% |
| 881  | cupidr           | Xiaomi         | 12                        | Snapdragon 8 Gen 1 | 2021-12-31   | U      |       50 |     0.001% |
| 885  | c1s              | Samsung        | Galaxy Note20 (SM-N980F)  | Exynos 990         | 2020-08-21   | U      |       49 |     0.001% |
| 886  | j1x3gxx          | Samsung        | Galaxy J1 Duos (2016) (S… | Spreadtrum SC9830  | 2016-01-01   | U      |       48 |     0.001% |
| 886  | cezanne          | Xiaomi         | Redmi K30 Ultra           | Dimensity 1000+ (… | 2020-08-14   | U      |       48 |     0.001% |
| 886  | TB8504F          | Lenovo         | Tab 4 8 (WiFi)            | Snapdragon 425     | 2017-09-15   | U      |       48 |     0.001% |
| 886  | RMX1801          | Realme         | Realme 2 Pro              | Snapdragon 660     | 2018-10-11   | D      |       48 |     0.001% |
| 890  | pocket2          | Retroid        | Pocket 2                  | MediaTek mt6580a   | 2020-08-01   | U      |       47 |     0.001% |
| 890  | nx523j           | Nubia          | Z11 Max                   | Snapdragon 652     | 2016-06-01   | U      |       47 |     0.001% |
| 890  | m14x             | Samsung        | Galaxy F14                | Exynos 1330        | 2023-03-30   | U      |       47 |     0.001% |
| 893  | q4q              | Samsung        | Galaxy Z Fold4, Galaxy F… | Snapdragon 8+ Gen… | 2022-08-25   | U      |       46 |     0.001% |
| 893  | logan2g          | Samsung        | Galaxy Star Pro Duos (GT… | Spreadtrum SC6820  | 2013-10-01   | U      |       46 |     0.001% |
| 893  | hl3g             | Samsung        | Galaxy Note3 Neo (SM-N75… | Exynos 5260 Hexa   | 2014-02-01   | U      |       46 |     0.001% |
| 893  | ef63             | Pantech        | VEGA Iron 2               | Snapdragon 801     | 2014-05-01   | U      |       46 |     0.001% |
| 897  | zeekr            | Motorola       | Razr 40 Ultra             | Snapdragon 8+ Gen… | 2023-06-05   | U      |       45 |     0.001% |
| 897  | rhannah          | Motorola       | moto e5 plus (XT1924-1/2… | Snapdragon 425     | 2018-05-01   | D      |       45 |     0.001% |
| 897  | pissarro         | Xiaomi         | Redmi Note 11 Pro, Redmi… | Helio G96          | 2022-02-18   | U      |       45 |     0.001% |
| 897  | mediapadm5lte    | Huawei         | Huawei MediaPad M5 lite   | Kirin 659          | 2018-10-01   | U      |       45 |     0.001% |
| 897  | me173x           | ASUS           | Memo Pad HD7 (MT8125)     | Mediatek MT8125    | 2013-07-01   | U      |       45 |     0.001% |
| 897  | kltechn          | Samsung        | Galaxy S5 LTE (G9006V/8V) | Snapdragon 801     | 2014-04-01   | D      |       45 |     0.001% |
| 897  | f41              | Samsung        | F41                       | Exynos 9611 (10 n… | 2020-10-16   | U      |       45 |     0.001% |
| 897  | denniz           | OnePlus        | Nord 2 5G                 | Dimensity 1200 (6… | 2021-07-28   | U      |       45 |     0.001% |
| 897  | b4q              | Samsung        | Galaxy Z Flip 4 5G        | Snapdragon 8+ Gen… | 2022-08-25   | U      |       45 |     0.001% |
| 897  | a04              | Samsung        | Galaxy A04                | Helio P35 MT6765   | 2022-10-10   | U      |       45 |     0.001% |
| 897  | RMX3852          | Realme         | GT Neo6                   | Snapdragon 8s Gen… | 2024-05-09   | U      |       45 |     0.001% |
| 897  | LH7n             | TECNO          | Pova 5 (LH7n)             | Helio G99          | 2023-07-01   | U      |       45 |     0.001% |
| 909  | h815             | LG             | G4 (International)        | Snapdragon 808     | 2015-06-01   | D      |       44 |     0.001% |
| 909  | e1s              | Samsung        | Galaxy S24 (SM-S921B/N)   | Exynos 2400        | 2024-01-24   | U      |       44 |     0.001% |
| 909  | c2502t_cm8900pl… | C Idea         | CM8900 Plus               | Snapdragon QT615   | 2025-09-24   | U      |       44 |     0.001% |
| 909  | RMX2001          | Realme         | 6                         | Helio G90T (12 nm) | 2020-03-11   | U      |       44 |     0.001% |
| 913  | tilapia          | ASUS           | Nexus 7 3G (2012)         | Tegra 3 T30L       | 2012-07-13   | U      |       43 |     0.001% |
| 913  | psyche           | Xiaomi         | 12X                       | Snapdragon 870 5G  | 2021-12-31   | U      |       43 |     0.001% |
| 913  | le_x620          | LeEco          | Le 2                      | Helio X20 MT6797   | 2016-04-01   | U      |       43 |     0.001% |
| 913  | a3core           | Samsung        | Galaxy A03 Core           | Unisoc SC9863A (2… | 2021-12-06   | U      |       43 |     0.001% |
| 913  | a31              | Samsung        | Galaxy A31                | Helio P65          | 2020-04-27   | U      |       43 |     0.001% |
| 918  | thea             | Motorola       | moto g LTE (2014)         | Snapdragon 400     | 2015-01-01   | D      |       42 |    0.0010% |
| 918  | radxa0           | Radxa          | Zero (Android TV)         | Amlogic S905Y2     | 2020-12-01   | O      |       42 |    0.0010% |
| 918  | jackpot2lte      | Samsung        | Galaxy A8+ 2018           | Exynos 7885        | 2018-01-01   | U      |       42 |    0.0010% |
| 918  | frd              | Huawei         | Honor 8                   | Kirin 950          | 2016-07-01   | U      |       42 |    0.0010% |
| 918  | eyeul            | HTC            | Desire Eye                | Snapdragon 801     | 2014-11-01   | U      |       42 |    0.0010% |
| 918  | breeze           | Xiaomi         | Poco M6 Plus 5G, Redmi 1… | Snapdragon 4 Gen … | 2024-07-12   | U      |       42 |    0.0010% |
| 918  | X3               |                |                           |                    |              | U      |       42 |    0.0010% |
| 918  | P661N            | Itel           | P55 5G, Power 55 5G       | Dimensity 6080     | 2023-10-05   | U      |       42 |    0.0010% |
| 926  | zizhan           | Xiaomi         | MIX Fold 2                | Snapdragon 8+ Gen1 | 2022-08-11   | O      |       41 |    0.0010% |
| 926  | t6               | HTC            | One Max (GSM)             | Snapdragon 600     | 2013-10-01   | D      |       41 |    0.0010% |
| 926  | parker           | Motorola       | one zoom                  | Snapdragon 675     | 2019-09-05   | D      |       41 |    0.0010% |
| 926  | mi439            | Xiaomi         | Redmi 8A Dual             | Snapdragon 439     | 2019-10-01   | U      |       41 |    0.0010% |
| 926  | kltedcmactive    | Samsung        | Galaxy S5 Active (G870A)  | Snapdragon 801     | 2014-05-01   | U      |       41 |    0.0010% |
| 926  | k3gxx            | Samsung        | Galaxy S5 (International… | Exynos 5422        | 2014-03-01   | D      |       41 |    0.0010% |
| 926  | hennessy         | Xiaomi         | Redmi Note 3 (mediatek)   | Snapdragon 650     | 2016-03-03   | U      |       41 |    0.0010% |
| 926  | betalm           | LG             | G8s ThinQ                 | Snapdragon 855     | 2019-06-01   | D      |       41 |    0.0010% |
| 934  | vela             | Xiaomi         | Mi CC9 Meitu Edition      | Snapdragon 710     | 2019-09-01   | O      |       40 |    0.0009% |
| 934  | hllte            | Samsung        | Galaxy Note 3 Neo         | Exynos 5260 Hexa   | 2014-02-01   | U      |       40 |    0.0009% |
| 934  | gprimelte        | Samsung        | Galaxy Grand Prime        | Snapdragon 410     | 2014-10-01   | U      |       40 |    0.0009% |
| 934  | find7            | OPPO           | Find 7a, Find 7s          | Snapdragon 801     | 2014-03-19   | D      |       40 |    0.0009% |
| 934  | a24              | Samsung        | Galaxy A24 4G             | Helio G99          | 2023-05-05   | U      |       40 |    0.0009% |
| 934  | Amber            | Yandex         | Phone                     | Snapdragon 630     | 2018-12-01   | D      |       40 |    0.0009% |
| 940  | zangyapro        | BQ             | Aquaris X2 Pro            | Snapdragon 626     | 2017-06-01   | D      |       39 |    0.0009% |
| 940  | tiro             | Nubia          | Red Magic 9 Pro           | Snapdragon 8 Gen 3 | 2023-11-23   | U      |       39 |    0.0009% |
| 940  | halo             | Lenovo         | Legion Y70                | Snapdragon 8+ Gen… | 2022-08-23   | U      |       39 |    0.0009% |
| 940  | Z500             | Acer           | Liquid Z500               | Mediatek MT6582 (… | 2014-09-01   | U      |       39 |    0.0009% |
| 944  | androidbox       |                |                           |                    |              | U      |       38 |    0.0009% |
| 944  | a25x             | Samsung        | Galaxy A25 5G             | Exynos 1280        | 2023-12-16   | U      |       38 |    0.0009% |
| 944  | a23xq            | Samsung        | Galaxy A23 5G SM-A2360    | Snapdragon 695 5G… | 2022-09-02   | U      |       38 |    0.0009% |
| 944  | a16              | HTC            | Desire 530                | Snapdragon 210     | 2016-03-01   | U      |       38 |    0.0009% |
| 944  | a10s             | Samsung        | Galaxy M01s               | Helio P22          | 2020-07-16   | U      |       38 |    0.0009% |
| 944  | RMX1805          | Realme         | 2 Pro                     | Snapdragon 660 (1… | 2018-10-01   | U      |       38 |    0.0009% |
| 950  | zerofltecan      | Samsung        | Galaxy S6 (SM-G920F)      | Exynos 7420 Octa   | 2015-04-01   | U      |       37 |    0.0009% |
| 950  | vs995            | LG             | V20 (Verizon)             | Snapdragon 820     | 2016-10-01   | D      |       37 |    0.0009% |
| 950  | rubens           | Xiaomi         | Redmi K50                 | Dimensity 8100     | 2022-03-22   | U      |       37 |    0.0009% |
| 950  | roth             | NVIDIA         | Shield Portable           | Tegra 4 (T114)     | 2013-07-31   | D      |       37 |    0.0009% |
| 950  | kylepro          | Samsung        | Galaxy Trend Plus (GT-S7… | Broadcom BCM21664  | 2013-12-02   | U      |       37 |    0.0009% |
| 950  | g0s              | Samsung        | Galaxy S22+ 5G (SM-S906B) | Exynos 2200        | 2022-02-25   | U      |       37 |    0.0009% |
| 950  | MT6893           |                |                           | Dimensity 1200 (M… | 2021-01-19   | U      |       37 |    0.0009% |
| 957  | ziti             | OnePlus        | Nord CE3                  | Snapdragon 782G (… | 2023-08-05   | U      |       36 |    0.0008% |
| 957  | m30lte           | Samsung        | Galaxy M30                | Exynos 7904 (14 n… | 2019-03-07   | U      |       36 |    0.0008% |
| 957  | m307fn           | Samsung        | M30s (SM-M307FN)          | Exynos 9611 (10 n… | 2019-10-30   | U      |       36 |    0.0008% |
| 957  | cruiserltesq     | Samsung        | Galaxy S8 Active (SM-G89… | Snapdragon 835     | 2017-08-01   | U      |       36 |    0.0008% |
| 957  | corot            | Xiaomi         | Redmi K60 Ultra           | Dimensity 9200+ (… | 2023-08-15   | U      |       36 |    0.0008% |
| 957  | a14x             | Samsung        | Galaxy A14 5G             | Exynos 1330        | 2023-01-12   | U      |       36 |    0.0008% |
| 957  | Z00T             | ASUS           | Zenfone 2 Laser (1080p),… | Snapdragon 615     | 2015-11-01   | D      |       36 |    0.0008% |
| 957  | PAN_sprout       | Nokia          | 4.2                       | Snapdragon 439     | 2019-05-07   | U      |       36 |    0.0008% |
| 957  | KL5              | TECNO          | SPARK 30C (KL5)           | Helio G81          | 2024-09-15   | U      |       36 |    0.0008% |
| 966  | r0s              | Samsung        | Galaxy S22 (SM-S901B)     | Snapdragon 8 Gen 1 | 2022-02-25   | U      |       35 |    0.0008% |
| 966  | charlotte        | Huawei         | P20 Pro                   | Kirin 970          | 2018-04-01   | D      |       35 |    0.0008% |
| 966  | 2036             |                |                           |                    |              | U      |       35 |    0.0008% |
| 966  | 2027             |                |                           |                    |              | U      |       35 |    0.0008% |
| 970  | us996            | LG             | V20 (GSM Unlocked)        | Snapdragon 820     | 2016-10-01   | D      |       34 |    0.0008% |
| 970  | p6200            | Samsung        | Galaxy Tab 7.0 Plus (GT-… | Exynos 4210        | 2011-10-01   | U      |       34 |    0.0008% |
| 970  | fde_x86_64       |                |                           | x86_64             |              | U      |       34 |    0.0008% |
| 970  | ASUS_X00AD_2     | ASUS           | ZenFone Go (ZB500KL)      | Snapdragon 410 (2… | 2016-10-01   | U      |       34 |    0.0008% |
| 974  | taoyao           | Xiaomi         | 12 Lite                   | Snapdragon 778G    | 2022-07-11   | U      |       33 |    0.0008% |
| 974  | lentislte        | Samsung        | Galaxy S5 LTE-A           | Snapdragon 805     | 2014-07-15   | D      |       33 |    0.0008% |
| 974  | gts7xl           | Samsung        | Galaxy Tab S7+, Galaxy T… | Snapdragon 865+    | 2020-08-21   | U      |       33 |    0.0008% |
| 974  | e8               | HTC            | One E8                    | Snapdragon 801 (2… | 2014-06-01   | U      |       33 |    0.0008% |
| 974  | a55x             | Samsung        | Galaxy A55 5G             | Exynos 1480        | 2024-03-01   | U      |       33 |    0.0008% |
| 979  | star             | Xiaomi         | Mi 11 Ultra               | Snapdragon 888     | 2021-04-01   | U      |       32 |    0.0008% |
| 979  | rubyx            | Xiaomi         | Redmi Note 12 Pro, Pro P… | Dimensity 1080 (6… | 2022-11-01   | U      |       32 |    0.0008% |
| 979  | pele             | Huawei         | MediaPad T2 7.0 Pro       | Snapdragon 615 MS… | 2016-09-01   | U      |       32 |    0.0008% |
| 979  | m01q             | Samsung        | Galaxy M01                | Snapdragon 439     | 2020-06-02   | U      |       32 |    0.0008% |
| 979  | loganreltexx     | Samsung        | Galaxy Ace 3 LTE (S7275)  | Snapdragon 400     | 2013-07-01   | U      |       32 |    0.0008% |
| 979  | hiae             | HTC            | One A9                    | Snapdragon 617     | 2015-10-20   | D      |       32 |    0.0008% |
| 979  | bathena          | Motorola       | defy 2021                 | Snapdragon 662     | 2021-06-01   | O      |       32 |    0.0008% |
| 979  | X00P             | ASUS           | Zenfone Max M1            | Snapdragon 430     | 2018-12-01   | D      |       32 |    0.0008% |
| 979  | OP4F2F           | OPPO           | A15s                      | Helio P35          | 2020-12-18   | U      |       32 |    0.0008% |
| 988  | vns              | Huawei         | P9 Lite, G9 Lite, Honor … | Kirin 650 (16 nm)  | 2016-05-15   | U      |       31 |    0.0007% |
| 988  | venice           | Blackberry     | Priv                      | Snapdragon 808 MS… | 2015-11-01   | U      |       31 |    0.0007% |
| 988  | nobleltezt       | Samsung        | Galaxy Note5              | Exynos 7420 Octa   | 2015-08-21   | U      |       31 |    0.0007% |
| 988  | j5xnltexx        | Samsung        | Galaxy J5 (2016)          | Snapdragon 410     | 2015-04-01   | U      |       31 |    0.0007% |
| 988  | a5y17ltecan      | Samsung        | Galaxy A5 (2017) (SM-A52… | Exynos 7880        | 2017-01-01   | U      |       31 |    0.0007% |
| 988  | TB3710F          | Lenovo         | Tab 3 710f                | Mediatek MT8161    | 2016-04-01   | U      |       31 |    0.0007% |
| 988  | KJ7              | Tecno          | SPARK 20 Pro+             | Helio G99 Ultimate | 2024-02-09   | U      |       31 |    0.0007% |
| 995  | wt86528          | Lenovo         | A6010, K31-t3, wt86528    | Snapdragon 410     | 2015-10-01   | U      |       30 |    0.0007% |
| 995  | sltexx           | Samsung        | Galaxy Alpha              | Exynos 5430 Octa   | 2014-09-01   | U      |       30 |    0.0007% |
| 995  | h872             | LG             | G6 (T-Mobile)             | Snapdragon 821     | 2017-02-01   | D      |       30 |    0.0007% |
| 995  | eagle            | Sony           | Xperia M2                 | Snapdragon 400 (2… | 2014-05-01   | U      |       30 |    0.0007% |
| 995  | e8d              | HTC            | One E8 (dual SIM)         | Snapdragon 801 (2… | 2014-06-01   | U      |       30 |    0.0007% |
| 995  | TB2X30L          | Lenovo         | Tab2 A10-30L (TB2-X30L)   | Snapdragon 210     | 2015-09-01   | U      |       30 |    0.0007% |
| 1001 | x3               | Realme         | X3, X3 SuperZoom          | Snapdragon 855+ S… | 2020-06-30   | U      |       29 |    0.0007% |
| 1001 | l01k             | LG             | V30 (Japan)               | Snapdragon 835     | 2017-08-01   | O      |       29 |    0.0007% |
| 1001 | e53g             | Samsung        | Galaxy E5 (SM-E500H)      | Snapdragon 410 (M… | 2015-02-01   | U      |       29 |    0.0007% |
| 1001 | a13ve            | Samsung        | Galaxy A13 (SM-A137F)     | Helio G80          | 2022-07-01   | U      |       29 |    0.0007% |
| 1001 | TB3-850M         | Lenovo         | Tab3 8                    | Mediatek MT8161 (… | 2016-06-01   | U      |       29 |    0.0007% |
| 1001 | K2               |                |                           |                    |              | U      |       29 |    0.0007% |
| 1007 | star2qltecs      | Samsung        | Galaxy S9+ (SM-G965W)     | Snapdragon 845     | 2018-03-01   | U      |       28 |    0.0007% |
| 1007 | memul            | HTC            | One Mini 2                | Snapdragon 400 (2… | 2014-05-01   | U      |       28 |    0.0007% |
| 1007 | j1minivelte      | Samsung        | Galaxy J1 Mini Prime (SM… | Spreadtrum SC9830  | 2016-12-01   | U      |       28 |    0.0007% |
| 1007 | ef59             | Pantech        | VEGA Secret Note          | Snapdragon 800 (M… | 2013-10-01   | U      |       28 |    0.0007% |
| 1007 | delos3geur       | Samsung        | Galaxy Win, Galaxy Grand… | Snapdragon 200     | 2013-05-01   | U      |       28 |    0.0007% |
| 1007 | d2att            | Samsung        | Galaxy S III (AT&T)       | Snapdragon S4 Plus | 2012-06-28   | D      |       28 |    0.0007% |
| 1007 | atom             | Xiaomi         | Redmi 10X (atom, M2004J7… | Dimensity 820      | 2020-05-01   | U      |       28 |    0.0007% |
| 1014 | nx606j           | Nubia          | Z18                       | Snapdragon 845     | 2018-09-01   | O      |       27 |    0.0006% |
| 1014 | j5ltechn         | Samsung        | Galaxy J5 (SM-J5008)      | Snapdragon 410     | 2015-06-01   | U      |       27 |    0.0006% |
| 1014 | j2xlte           | Samsung        | J2 (2016)                 | Spreadtrum SC8830  | 2016-07-01   | U      |       27 |    0.0006% |
| 1014 | ivy              | Sony           | Xperia Z3+                | Snapdragon 810     | 2015-06-01   | D      |       27 |    0.0006% |
| 1014 | a3xeltexx        | Samsung        | Galaxy A3 (2016)          | Exynos 7578        | 2015-12-01   | U      |       27 |    0.0006% |
| 1014 | T00F             | ASUS           | Zenfone 5 (A501CG)        | Atom Z2520         | 2015-01-01   | U      |       27 |    0.0006% |
| 1014 | 2026             |                |                           |                    |              | U      |       27 |    0.0006% |
| 1021 | spartan          | Realme         | GT Neo 3T (RMX3371)       | Snapdragon 870 5G… | 2022-06-25   | U      |       26 |    0.0006% |
| 1021 | ms01lte          | Samsung        | Galaxy Grand2             | Snapdragon 400 MS… | 2013-12-01   | U      |       26 |    0.0006% |
| 1021 | lexus            | OnePlus        | Nord 5                    | Snapdragon 8s Gen… | 2025-07-08   | U      |       26 |    0.0006% |
| 1021 | dream2qltesq     | Samsung        | Galaxy S8+ (SM-G955U)     | Snapdragon 835     | 2017-04-01   | U      |       26 |    0.0006% |
| 1021 | certus64         | Xiaomi         | Redmi 6, Redm 6A          | Helio P22 MT6762   | 2018-06-01   | U      |       26 |    0.0006% |
| 1021 | bloomq           | Samsung        | Galaxy Z Flip             | Snapdragon 855+    | 2020-02-14   | U      |       26 |    0.0006% |
| 1021 | beyond2          | Samsung        | Galaxy S10+ (SM-G975F)    | Exynos 9820 Octa   | 2019-03-08   | U      |       26 |    0.0006% |
| 1028 | w7               | LG             | L90                       | Snapdragon 400     | 2014-02-01   | D      |       25 |    0.0006% |
| 1028 | r0q              | Samsung        | Galaxy S22 5G             | Snapdragon 8 Gen 1 | 2022-02-25   | U      |       25 |    0.0006% |
| 1028 | porsche          | Realme         | GT 2                      | Snapdragon 888 5G  | 2022-01-04   | U      |       25 |    0.0006% |
| 1028 | nx591j           | ZTE            | Z17 Lite (NX591J)         | Snapdragon 653     | 2017-04-01   | U      |       25 |    0.0006% |
| 1028 | g2m              | LG             | G2 Mini                   | Snapdragon 400     | 2014-04-01   | D      |       25 |    0.0006% |
| 1028 | arubaslim        | Samsung        | Galaxy Core (GT-I8262)    | Snapdragon S4 Pla… | 2013-05-01   | U      |       25 |    0.0006% |
| 1028 | alphalm          | LG             | G8 ThinQ (LM-G820)        | Snapdragon 855     | 2019-04-11   | U      |       25 |    0.0006% |
| 1028 | Z00A             | ASUS           | Zenfone 2 (1080p)         | Atom Z3580         | 2015-03-01   | D      |       25 |    0.0006% |
| 1028 | X00I             | ASUS           | ZenFone 4 Max (ZC554KL)   | Snapdragon 430     | 2017-07-01   | U      |       25 |    0.0006% |
| 1037 | z2_row           | ZUK            | Z2 Pro                    | Snapdragon 820     | 2016-06-01   | U      |       24 |    0.0006% |
| 1037 | scale            |                |                           |                    |              | U      |       24 |    0.0006% |
| 1037 | m2note           | Meizu          | M2 Note, Blue Charm Note2 | Mediatek MT6753 (… | 2015-06-01   | U      |       24 |    0.0006% |
| 1037 | jag3gds          | LG             | G3 S                      | Snapdragon 400     | 2014-08-01   | D      |       24 |    0.0006% |
| 1037 | ebba             | OnePlus        | Nord CE 5G                | Snapdragon 750G    | 2021-06-11   | U      |       24 |    0.0006% |
| 1037 | cherry           | Huawei         | Honor 4, Honor 4X         | Snapdragon 410 (M… | 2014-10-01   | D      |       24 |    0.0006% |
| 1037 | c2q              | Samsung        | Galaxy Note20 Ultra 5G    | Snapdragon 865+    | 2020-08-21   | U      |       24 |    0.0006% |
| 1037 | Z00L             | ASUS           | Zenfone 2 Laser (720p)    | Snapdragon 410     | 2015-11-01   | D      |       24 |    0.0006% |
| 1045 | z3dual           | Sony           | Xperia Z3 Dual            | Snapdragon 801     | 2014-09-01   | U      |       23 |    0.0005% |
| 1045 | ulova            | Xiaomi         | Redmi 4A, Redmi 5A, Redm… | Snapdragon 425     | 2016-11-01   | U      |       23 |    0.0005% |
| 1045 | tenet            |                |                           |                    |              | U      |       23 |    0.0005% |
| 1045 | paella           | BQ             | Aquaris X5                | Snapdragon 412     | 2015-10-14   | D      |       23 |    0.0005% |
| 1045 | nx619j           | Nubia          | Red Magic Mars            | Snapdragon 845     | 2018-12-01   | O      |       23 |    0.0005% |
| 1045 | m5_tab           | Banana Pi      | M5 (Tablet)               | Amlogic S905X3     | 2020-12-01   | O      |       23 |    0.0005% |
| 1045 | j7duolte         | Samsung        | Galaxy J7 Duo (SM-J720F/… | Exynos 7885        | 2018-04-01   | U      |       23 |    0.0005% |
| 1045 | emerald          | Teracube       | 2e (2022)                 | Helio A25          | 2022-02-22   | U      |       23 |    0.0005% |
| 1045 | ef60             | Pantech        | VEGA Secret UP (EF60S)    | Snapdragon 800     | 2013-12-01   | U      |       23 |    0.0005% |
| 1045 | dm2q             | Samsung        | Galaxy S23+ (SM-S9160)    | Snapdragon 8 Gen … | 2023-02-01   | U      |       23 |    0.0005% |
| 1045 | a5dwg            | HTC            | Desire 816 dual SIM       | Snapdragon 400 (2… | 2014-05-01   | U      |       23 |    0.0005% |
| 1056 | ziyi             | Xiaomi         | 13 Lite                   | Snapdragon 7 Gen 1 | 2023-02-26   | U      |       22 |    0.0005% |
| 1056 | z3q              | Samsung        | Galaxy S20 Ultra 5G       | Snapdragon 865 5G  | 2020-03-06   | U      |       22 |    0.0005% |
| 1056 | starqltesq       | Samsung        | Galaxy S9 (SM-G960U)      | Snapdragon 845     | 2018-03-09   | U      |       22 |    0.0005% |
| 1056 | starqltecs       | Samsung        | Galaxy S9 (SM-G960W)      | Snapdragon 845 (1… | 2018-03-09   | U      |       22 |    0.0005% |
| 1056 | juice            | Xiaomi         | Redmi 9T, POCO M3, Redmi… | Snapdragon 662     | 2021-01-08   | U      |       22 |    0.0005% |
| 1056 | hi6250           | Huawei         | P9 Lite                   | Kirin 650          | 2016-04-20   | U      |       22 |    0.0005% |
| 1056 | hero2ltektt      | Samsung        | Galaxy S7 Edge (SM-G935K) | Exynos 8 Octa 889… | 2016-03-11   | U      |       22 |    0.0005% |
| 1056 | gts9wifi         | Samsung        | Galaxy Tab S9 (SM-X710)   | Snapdragon 8 Gen 2 | 2023-08-11   | U      |       22 |    0.0005% |
| 1056 | eqe              | Motorola       | edge 50 pro               | Snapdragon 7 Gen 3 | 2024-04-08   | U      |       22 |    0.0005% |
| 1056 | chef             | Motorola       | one power                 | Snapdragon 636     | 2018-10-10   | D      |       22 |    0.0005% |
| 1056 | a5y17ltelgt      | Samsung        | Galaxy A5 (2017) (SM-A52… | Exynos 7 Octa 7880 | 2017-01-01   | U      |       22 |    0.0005% |
| 1056 | a5ul             | HTC            | Desire 816                | Snapdragon 400     | 2014-04-01   | U      |       22 |    0.0005% |
| 1056 | CK8n             | TECNO          | CAMON 20 Pro 5G           | Dimensity 8050     | 2023-05-09   | U      |       22 |    0.0005% |
| 1069 | us996d           | LG             | V20 (GSM Unlocked - Dirt… | Snapdragon 820     | 2016-10-01   | D      |       21 |    0.0005% |
| 1069 | star2lteks       | Samsung        | Galaxy S9+ (SM-G965N)     | Exynos 9 Octa 981… | 2018-03-01   | U      |       21 |    0.0005% |
| 1069 | smi              | Motorola       | Razr I (XT890)            | Atom Z2460         | 2012-10-01   | U      |       21 |    0.0005% |
| 1069 | sirisu           | Google         | Pixel 2 XL                | Snapdragon 835     | 2017-10-17   | U      |       21 |    0.0005% |
| 1069 | kltedcm          | Samsung        | Galaxy S5 (G900T)         | Snapdragon 801 MS… | 2014-04-11   | U      |       21 |    0.0005% |
| 1069 | OP4863           | OnePlus        | 13                        | Snapdragon 8 Elit… | 2024-11-01   | U      |       21 |    0.0005% |
| 1069 | OP46B1           | OPPO           | Reno 标准版  (PCAM00)        | Snapdragon 710     | 2019-04-01   | U      |       21 |    0.0005% |
| 1076 | winner           | Samsung        | Galaxy Fold, Galaxy Fold… | Snapdragon 855     | 2019-04-01   | U      |       20 |    0.0005% |
| 1076 | shamrock         | General Mobile | GM 5 Plus                 | Snapdragon 617     | 2016-02-01   | U      |       20 |    0.0005% |
| 1076 | plato            | Xiaomi         | 12T                       | Dimensity 8100-Ul… | 2022-10-01   | U      |       20 |    0.0005% |
| 1076 | h96_max_x3       | H96            | Max X3                    | Amlogic S905X3     | 2020-02-01   | U      |       20 |    0.0005% |
| 1076 | fortunafz        | Samsung        | Galaxy Grand Prime (SM-S… | Snapdragon 410 (M… | 2014-10-01   | U      |       20 |    0.0005% |
| 1076 | b0s              | Samsung        | Galaxy S22 Ultra (SM-S90… | Exynos 2200        | 2022-02-25   | U      |       20 |    0.0005% |
| 1076 | amber            | Xiaomi         | 11T                       | Dimensity 1200-Ul… | 2021-10-05   | U      |       20 |    0.0005% |
| 1076 | TP1803           | Nubia          | Mini 5G                   | Snapdragon 855     | 2019-04-01   | O      |       20 |    0.0005% |
| 1084 | udon             | Xiaomi         | Mi MIX 4                  | Snapdragon 888+ 5… | 2021-08-16   | U      |       19 |    0.0004% |
| 1084 | penangf          | Motorola       | moto g13                  | Helio G85 (MT6769… | 2023-01-24   | U      |       19 |    0.0004% |
| 1084 | penang           | Motorola       | moto G53 (XT2335-3)       | Snapdragon 480 Pl… | 2022-12-15   | U      |       19 |    0.0004% |
| 1084 | m33x             | Samsung        | Galaxy Jump2              | Dimensity 700      | 2022-06-01   | U      |       19 |    0.0004% |
| 1084 | kltechnduo       | Samsung        | Galaxy S5 LTE Duos (G900… | Snapdragon 801     | 2014-04-01   | D      |       19 |    0.0004% |
| 1084 | e1q              | LG             | K4 (LG-K120GT, LG-K121, … | Snapdragon 210     | 2016-02-01   | U      |       19 |    0.0004% |
| 1084 | c1q              | Samsung        | Galaxy Note20 5G (SM-N98… | Snapdragon 8 Gen 3 | 2020-08-21   | U      |       19 |    0.0004% |
| 1084 | a20s             | Samsung        | Galaxy A20s               | Snapdragon 450     | 2019-10-05   | U      |       19 |    0.0004% |
| 1084 | KJ5              | TECNO          | SPARK 20                  | Helio G85          | 2023-12-01   | U      |       19 |    0.0004% |
| 1093 | nobleltetmo      | Samsung        | Galaxy Note5              | Exynos 7420 Octa   | 2015-08-01   | U      |       18 |    0.0004% |
| 1093 | jagnm            | LG             | G3 Beat                   | Snapdragon 400     | 2014-08-01   | D      |       18 |    0.0004% |
| 1093 | houji            | Xiaomi         | 14                        | Snapdragon 8 Gen 3 | 2023-11-01   | U      |       18 |    0.0004% |
| 1096 | zangya           | BQ             | Aquaris X2                | Snapdragon 636     | 2018-05-01   | D      |       17 |    0.0004% |
| 1096 | passion          | Lenovo         | Vibe P1                   | Snapdragon 615     | 2015-10-01   | U      |       17 |    0.0004% |
| 1096 | odroidgo3        | HardKernel     | ODROID go3                |                    | 2022-10-04   | U      |       17 |    0.0004% |
| 1096 | m53x             | Samsung        | Galaxy M53 5G (SM-M536B,… | Dimensity 900 5G   | 2022-04-07   | U      |       17 |    0.0004% |
| 1096 | klteaio          | Samsung        | Galaxy S5 LTE (G900AZ/S9… | Snapdragon 801     | 2014-04-11   | D      |       17 |    0.0004% |
| 1096 | j5ltekx          | Samsung        | Galaxy J5 (SM-J500N0)     | Snapdragon 410     | 2015-06-01   | U      |       17 |    0.0004% |
| 1096 | h815_usu         | LG             | G4                        | Snapdragon 808     | 2015-04-01   | U      |       17 |    0.0004% |
| 1096 | greatqlte        | Samsung        | Galaxy Note8 (SM-N9500)   | Snapdragon 835     | 2017-09-01   | U      |       17 |    0.0004% |
| 1096 | d2spr            | Samsung        | Galaxy S III (Sprint)     | Snapdragon S4 Plus | 2012-06-28   | D      |       17 |    0.0004% |
| 1096 | apollopro        | Xiaomi         | Mi 10T pro                | Snapdragon 865     | 2020-10-13   | U      |       17 |    0.0004% |
| 1096 | X00H             | ASUS           | ZenFone 4 Max (ZC520KL)   | Qualcomm Snapdrag… | 2017-07-01   | U      |       17 |    0.0004% |
| 1096 | OP4BA5L1         | OPPO           | OPPO Reno 4 (CPH2109, CP… | Snapdragon 720G    | 2020-08-01   | U      |       17 |    0.0004% |
| 1108 | tsubasa          | Sony           | Xperia V                  | Snapdragon S4      | 2012-09-01   | D      |       16 |    0.0004% |
| 1108 | poplar_kddi      | Sony           | Xperia XZ1 (SOV36)        | Snapdragon 835     | 2017-09-19   | U      |       16 |    0.0004% |
| 1108 | owens            | Motorola       | Moto E4 Plus (Qualcomm)   | Qualcomm Snapdrag… | 2017-06-01   | U      |       16 |    0.0004% |
| 1108 | mint             | Sony           | Xperia T                  | Snapdragon S4      | 2012-09-01   | D      |       16 |    0.0004% |
| 1108 | m8d              | HTC            | One (M8) Dual SIM         | Snapdragon 801     | 2014-06-01   | D      |       16 |    0.0004% |
| 1108 | luigi            | Realme         | 10 Pro 5G                 | Snapdragon 695 (S… | 2022-11-24   | O      |       16 |    0.0004% |
| 1108 | fortunalteub     | Samsung        | Galaxy Grand Prime  (for… | Snapdragon 410     | 2014-10-01   | U      |       16 |    0.0004% |
| 1115 | wly              | OnePlus        | 10 Pro                    | Snapdragon 8 Gen 1 | 2022-01-13   | U      |       15 |    0.0004% |
| 1115 | vitamin          | OnePlus        | Nord 3                    | Dimensity 9000     | 2023-07-11   | U      |       15 |    0.0004% |
| 1115 | ulysse           | Xiaomi         | Redmi Note 5A, Redmi Not… | Snapdragon 425 or… | 2017-08-01   | U      |       15 |    0.0004% |
| 1115 | taoshan          | Sony           | Xperia L                  | Snapdragon 400 (M… | 2013-05-01   | D      |       15 |    0.0004% |
| 1115 | sydneym          | Huawei         | Mate 20 Lite              | Kirin 710          | 2018-09-01   | U      |       15 |    0.0004% |
| 1115 | sisleyr          | Lenovo         | S90-A Sisley              | Snapdragon 410 (M… | 2014-11-01   | U      |       15 |    0.0004% |
| 1115 | r7sf             | OPPO           | R7s (International)       | Snapdragon 615     | 2015-11-01   | D      |       15 |    0.0004% |
| 1115 | nx609j           | Nubia          | Red Magic                 | Snapdragon 835     | 2018-04-01   | D      |       15 |    0.0004% |
| 1115 | himaul           | HTC            | One M9 (GSM)              | Snapdragon 810     | 2015-03-01   | D      |       15 |    0.0004% |
| 1115 | ctwo             | Motorola       | edge 50 ultra             | Snapdragon 8s Gen… | 2024-05-01   | U      |       15 |    0.0004% |
| 1115 | a82xq            | Samsung        | Galaxy Quantum2           | Snapdragon 855+    | 2021-04-01   | U      |       15 |    0.0004% |
| 1115 | X6871            | Infinix        | GT 20 Pro                 | Dimensity 8200 Ul… | 2024-04-26   | U      |       15 |    0.0004% |
| 1115 | OP4EFDL1         | OPPO           | A53                       | Snapdragon 460     | 2020-08-25   | U      |       15 |    0.0004% |
| 1128 | tbelteskt        | Samsung        | Galaxy Note Edge          | Snapdragon 805     | 2014-11-01   | U      |       14 |    0.0003% |
| 1128 | expressltexx     | Samsung        | Galaxy Express (GT-I8730… | Snapdragon 400 (M… | 2013-03-01   | U      |       14 |    0.0003% |
| 1128 | dogo             | Sony           | Xperia ZR                 | Snapdragon S4 Pro  | 2013-06-01   | D      |       14 |    0.0003% |
| 1128 | cs02             | Samsung        | Galaxy Core Plus (SM-G35… | Broadcom BCM21664T | 2013-11-01   | U      |       14 |    0.0003% |
| 1128 | crownqltechn     | Samsung        | Galaxy Note9 (SM-N9600)   | Snapdragon 845     | 2018-08-01   | U      |       14 |    0.0003% |
| 1128 | a6010            | Lenovo         | A6010                     | Snapdragon 410     | 2015-11-01   | U      |       14 |    0.0003% |
| 1128 | OP4B79L1         | OPPO           | A5 (2020)                 | Snapdragon 665 (1… | 2019-10-01   | U      |       14 |    0.0003% |
| 1135 | zircon           | Xiaomi         | Redmi Note 13 Pro+        | Dimensity 7200 Ul… | 2023-09-21   | U      |       13 |    0.0003% |
| 1135 | v480             | LG             | G Pad 8.0 (Wi-Fi)         | Snapdragon 400 (M… | 2014-07-01   | D      |       13 |    0.0003% |
| 1135 | serranoltespr    | Samsung        | Galaxy S4 Mini (SPH-L520) | Snapdragon 400     | 2013-07-01   | U      |       13 |    0.0003% |
| 1135 | rio              | Huawei         | G8, GX8                   | Snapdragon 615 (2… | 2015-10-01   | U      |       13 |    0.0003% |
| 1135 | ph2n             | LG             | Stylo 2 Plus              | Snapdragon 430 (M… | 2016-07-01   | U      |       13 |    0.0003% |
| 1135 | nx651j           | Nubia          | Play 5G, Red Magic 5G Li… | Snapdragon 765G (… | 2020-04-01   | D      |       13 |    0.0003% |
| 1135 | lv517            | LG             | K20 (2019), K8+           | Mediatek MT6739    | 2019-09-01   | U      |       13 |    0.0003% |
| 1135 | dreamqlteue      | Samsung        | Galaxy S8 (SM-G950U1)     | Snapdragon 835     | 2017-04-24   | U      |       13 |    0.0003% |
| 1135 | d852             | LG             | G3 (Canada)               | Snapdragon 801     | 2014-06-01   | D      |       13 |    0.0003% |
| 1135 | a53gxx           | Samsung        | Galaxy A5 (SM-A500H)      | Snapdragon 410     | 2014-12-01   | U      |       13 |    0.0003% |
| 1135 | P1m              | Lenovo         | Vibe P1m                  | MediaTek MT6735P   | 2015-10-01   | U      |       13 |    0.0003% |
| 1146 | willow           | Xiaomi         | Redmi Note 8T             | Snapdragon 665 (1… | 2019-11-08   | U      |       12 |    0.0003% |
| 1146 | star2qlteue      | Samsung        | Galaxy S9+ (SM-G965U1)    | Snapdragon 845     | 2018-03-01   | U      |       12 |    0.0003% |
| 1146 | piccolo          | BQ             | Aquaris M5                | Snapdragon 615     | 2015-08-01   | D      |       12 |    0.0003% |
| 1146 | jfltevzw         | Samsung        | Galaxy S4 (SCH-I545)      | Snapdragon 600 (A… | 2013-04-01   | D      |       12 |    0.0003% |
| 1146 | j7xlte           | Samsung        | Galaxy J7 (2016) (SM-J71… | Exynos 7870        | 2016-04-01   | U      |       12 |    0.0003% |
| 1146 | h812_usu         | LG             | G4 (LG-H812)              | Snapdragon 808     | 2015-04-01   | U      |       12 |    0.0003% |
| 1146 | greatqlteue      | Samsung        | Galaxy Note8 SM-N950U1    | Snapdragon 835     | 2017-09-01   | U      |       12 |    0.0003% |
| 1146 | figo             | Huawei         | P Smart                   | Kirin 659          | 2017-12-01   | D      |       12 |    0.0003% |
| 1146 | f1f              | OPPO           | F1 (International)        | Snapdragon 615     | 2016-01-01   | D      |       12 |    0.0003% |
| 1146 | d2tmo            | Samsung        | Galaxy S III (T-Mobile)   | Snapdragon S4 Plu… | 2012-06-21   | D      |       12 |    0.0003% |
| 1156 | y560             | Huawei         | Y5, Y560                  | Snapdragon 210     | 2015-06-01   | U      |       11 |    0.0003% |
| 1156 | pdx223           | Sony           | Xperia 1 IV               | Snapdragon 8 Gen … | 2022-06-11   | U      |       11 |    0.0003% |
| 1156 | otus             | Motorola       | moto e (2015)             | Snapdragon 200 (M… | 2015-02-25   | D      |       11 |    0.0003% |
| 1156 | odroidn2l        | HardKernel     | ODROID-N2L                | Amlogic S922X      | 2022-11-01   | U      |       11 |    0.0003% |
| 1156 | kltevzw          | Samsung        | Galaxy S4 (Verizon, SCH-… | Snapdragon 600     | 2013-05-01   | U      |       11 |    0.0003% |
| 1156 | jflteatt         | Samsung        | Galaxy S4 (SGH-I337)      | Snapdragon 600     | 2013-04-01   | D      |       11 |    0.0003% |
| 1156 | flounder_lte     | Google         | Nexus 9 (LTE)             | Tegra K1 (T124)    | 2014-11-03   | D      |       11 |    0.0003% |
| 1156 | dreamqltecan     | Samsung        | Galaxy S8 (SM-G950W)      | Snapdragon 835     | 2017-04-21   | U      |       11 |    0.0003% |
| 1156 | d850             | LG             | G3 (AT&T)                 | Snapdragon 801     | 2014-06-01   | D      |       11 |    0.0003% |
| 1156 | A5_Pro           | Umidigi        | A5 Pro                    | Helio P23          | 2019-05-01   | U      |       11 |    0.0003% |
| 1166 | trelte           | Samsung        | Galaxy Note4 (SM-N910C)   | Exynos 5433        | 2014-10-01   | U      |       10 |    0.0002% |
| 1166 | sif              | NVIDIA         | Shield TV (2019) [Androi… | Tegra X1+ (T210b0… | 2019-10-28   | O      |       10 |    0.0002% |
| 1166 | prague           | Huawei         | P8 Lite (2017)            | Kirin 655          | 2017-01-01   | U      |       10 |    0.0002% |
| 1166 | messi            | Motorola       | moto z3                   | Snapdragon 835 (M… | 2018-08-01   | O      |       10 |    0.0002% |
| 1166 | ls990            | LG             | G3 (Sprint)               | Snapdragon 801     | 2014-06-01   | D      |       10 |    0.0002% |
| 1166 | jalebi           | YU             | Yunique                   | Snapdragon 410 (M… | 2015-09-01   | D      |       10 |    0.0002% |
| 1166 | i9100g           | Samsung        | Galaxy S2 Plus (GT-I9100… | OMAP 4430          | 2013-01-01   | U      |       10 |    0.0002% |
| 1166 | htc_820g_plus    | HTC            | Desire 820G+ dual sim     | MediaTek MT6592    | 2015-06-01   | U      |       10 |    0.0002% |
| 1166 | hayabusa         | Sony           | Xperia TX                 | Snapdragon S4      | 2012-08-01   | D      |       10 |    0.0002% |
| 1166 | gracerltektt     | Samsung        | Galaxy Note Fan Edition … | Exynos 8890        | 2017-07-07   | U      |       10 |    0.0002% |
| 1166 | gohan            | BQ             | Aquaris X5 Plus           | Snapdragon 652     | 2016-07-01   | D      |       10 |    0.0002% |
| 1166 | f400             | LG             | G3 (Korea)                | Snapdragon 801     | 2014-06-01   | D      |       10 |    0.0002% |
| 1166 | dream2qlteue     | Samsung        | Galaxy S8+ (SM-G955U1)    | Snapdragon 835 (1… | 2017-04-01   | U      |       10 |    0.0002% |
| 1166 | dream2qltecan    | Samsung        | Galaxy S8+ (SM-G955W)     | Snapdragon 835     | 2017-04-01   | U      |       10 |    0.0002% |
| 1166 | d851             | LG             | G3 (T-Mobile)             | Snapdragon 801     | 2014-06-01   | D      |       10 |    0.0002% |
| 1166 | a7lte            | Samsung        | Galaxy A7 (2018) (SM-A70… | Exynos 5430 Octa   | 2018-10-01   | U      |       10 |    0.0002% |
| 1166 | a5ltexx          | Samsung        | Galaxy A5 (SM-A500F/G)    | Snapdragon 410     | 2014-11-01   | U      |       10 |    0.0002% |
| 1183 | x500             | ZTE            | X500                      | Snapdragon S1 (MS… | 2011-09-26   | U      |        9 |    0.0002% |
| 1183 | trltexx          | Samsung        | Galaxy Note4 (SM-N910F/G… | Snapdragon 805     | 2014-10-01   | U      |        9 |    0.0002% |
| 1183 | toro             | Google         | Galaxy Nexus LTE (Verizo… | OMAP 4460          | 2011-12-15   | D      |        9 |    0.0002% |
| 1183 | paros            |                |                           |                    |              | U      |        9 |    0.0002% |
| 1183 | p7_l10           | Huawei         | Ascend P7 (P7-L10)        | Kirin 910T         | 2014-06-01   | U      |        9 |    0.0002% |
| 1183 | nicki            | Sony           | Xperia M                  | Snapdragon S4 Plus | 2013-06-01   | D      |        9 |    0.0002% |
| 1183 | h932             | LG             | V30 (T-Mobile)            | Snapdragon 835 (M… | 2017-08-01   | D      |        9 |    0.0002% |
| 1183 | frescoltekor     | Samsung        | Galaxy Note3 Neo (SM-N75… | Exynos 5260        | 2014-03-01   | U      |        9 |    0.0002% |
| 1183 | d800             | LG             | G2 (AT&T)                 | Snapdragon 800 (M… | 2013-09-12   | D      |        9 |    0.0002% |
| 1183 | coreprimeve3g    | Samsung        | Galaxy Core Prime (SM-G3… | Spreadtrum SC7730S | 2014-11-01   | U      |        9 |    0.0002% |
| 1183 | anne             | Huawei         | P20 Lite                  | Kirin 659          | 2018-03-01   | D      |        9 |    0.0002% |
| 1183 | a70s             | Samsung        | Galaxy A70s               | Snapdragon 675     | 2019-10-01   | U      |        9 |    0.0002% |
| 1183 | I01WD            | ASUS           | Zenfone 6 (ZS630KL)       | Snapdragon 855 (S… | 2019-05-16   | D      |        9 |    0.0002% |
| 1183 | GM8_sprout       | General Mobile | GM 8                      | Snapdragon 435     | 2018-02-01   | U      |        9 |    0.0002% |
| 1197 | w5               | LG             | Optimus L70               | Snapdragon 200     | 2014-04-01   | D      |        8 |    0.0002% |
| 1197 | vegetalte        | BQ             | Aquaris E5 4G, Aquaris E… | Snapdragon 410     | 2014         | D      |        8 |    0.0002% |
| 1197 | v410             | LG             | G Pad 7.0 (LTE)           | Snapdragon 400 (M… | 2014-05-01   | D      |        8 |    0.0002% |
| 1197 | sltecan          | Samsung        | Galaxy Alpha (SM-G850W)   | Exynos 5430        | 2014-09-01   | U      |        8 |    0.0002% |
| 1197 | r7plus           | OPPO           | R7 Plus (International)   | Snapdragon 615     | 2015-05-01   | D      |        8 |    0.0002% |
| 1197 | onc              | Xiaomi         | Redmi 7                   | Snapdragon 632     | 2019-03-20   | U      |        8 |    0.0002% |
| 1197 | obiwan           | ASUS           | ROG Phone 3               | Snapdragon 865+ (… | 2020-08-01   | D      |        8 |    0.0002% |
| 1197 | mdarcy           | NVIDIA         | Shield TV 2019 Pro [Andr… | Tegra X1+ (T210b0… | 2019-10-28   | D      |        8 |    0.0002% |
| 1197 | m8qlul           | HTC            | ONE M8s                   | Snapdragon 615 (M… | 2015-05-01   | U      |        8 |    0.0002% |
| 1197 | gtesqltespr      | Samsung        | Galaxy Tab E 8.0 LTE (Sp… | Snapdragon 410 (M… | 2016-01-01   | D      |        8 |    0.0002% |
| 1197 | gemstone         | Xiaomi         | POCO X5 5G, Redmi Note 1… | Snapdragon 4 Gen … | 2023-01-05   | U      |        8 |    0.0002% |
| 1197 | flashlm          | LG             | V50 (LM-V500XM), V50 Thi… | Snapdragon 855     | 2019-05-01   | U      |        8 |    0.0002% |
| 1197 | ef56             | Pantech        | Vega LTE-A                | Snapdragon 801 (M… | 2014-05-01   | U      |        8 |    0.0002% |
| 1197 | ahannah          | Motorola       | moto e5 plus (XT1924-3/9) | Snapdragon 430     | 2018-05-01   | D      |        8 |    0.0002% |
| 1211 | x1               |                |                           |                    |              | U      |        7 |    0.0002% |
| 1211 | urd              | ZTE            | Z981                      | Snapdragon 617     | 2016-07-01   | U      |        7 |    0.0002% |
| 1211 | unified7870      | Samsung        | Exynos 7870 Device        | Exynos 7870        |              | U      |        7 |    0.0002% |
| 1211 | s3_h560          | JiaYu          | S3                        | MediaTek MT6752    | 2015-01-01   | U      |        7 |    0.0002% |
| 1211 | r5xQ             | Realme         | 5, 5i, 5s                 | Snapdragon 665 SD… | 2019-08-01   | U      |        7 |    0.0002% |
| 1211 | poplar_canada    | Sony           | Xperia XZ1 (Canada)       | Snapdragon 835     | 2017-08-15   | U      |        7 |    0.0002% |
| 1211 | idol347          | Alcatel        | Onetouch Idol 3 (5.5)     | Snapdragon 615 (M… | 2015-06-01   | U      |        7 |    0.0002% |
| 1211 | h930             | LG             | V30 (LG-H930)             | Snapdragon 835     | 2017-09-21   | U      |        7 |    0.0002% |
| 1211 | caza             | Nubia          | Z60 Ultra, Red Magic 9 P… | Snapdragon 8 Gen … | 2023-12-19   | U      |        7 |    0.0002% |
| 1211 | Tiare_4_19       | Xiaomi         | Redmi Go (tiare)          | Snapdragon 425     | 2019-02-01   | U      |        7 |    0.0002% |
| 1221 | wilcoxltexx      | Samsung        | Galaxy Express 2, Galaxy… | Snapdragon S4      | 2013-10-01   | U      |        6 |    0.0001% |
| 1221 | v521             | LG             | G Pad X (T-Mobile)        | Snapdragon 617 (M… | 2016-06-01   | D      |        6 |    0.0001% |
| 1221 | v400             | LG             | G Pad 7.0 WiFi            | Snapdragon 400 (M… | 2014-07-01   | D      |        6 |    0.0001% |
| 1221 | osaka            | Motorola       | Moto G Stylus 5G 2021     | Snapdragon 480 5G  | 2021-06-14   | U      |        6 |    0.0001% |
| 1221 | maserati         | Motorola       | DROID 4                   | OMAP 4430          | 2012-02-10   | D      |        6 |    0.0001% |
| 1221 | ls997            | LG             | V20 (Sprint)              | Snapdragon 820 (M… | 2016-10-01   | D      |        6 |    0.0001% |
| 1221 | light            | Xiaomi         | POCO M4 5G, Redmi 10 5G … | Dimensity 700      | 2021-03-04   | U      |        6 |    0.0001% |
| 1221 | kltespr          | Samsung        | Galaxy S5 (SM-G900P)      | Snapdragon 801 (M… | 2014-04-01   | U      |        6 |    0.0001% |
| 1221 | fugu             | Google         | Nexus Player              | Atom Z3560         | 2014-10-01   | D      |        6 |    0.0001% |
| 1221 | ef71             | Pantech        | SKY IM-100                | Snapdragon 430 (M… | 2016-06-01   | U      |        6 |    0.0001% |
| 1221 | draconis         | ZTE            | Z970                      | Snapdragon 400 (M… | 2014-08-01   | U      |        6 |    0.0001% |
| 1221 | deadpool         | Google         | ADT-3                     | Amlogic S905Y2     | 2020-09-22   | O      |        6 |    0.0001% |
| 1221 | d801             | LG             | G2 (T-Mobile)             | Snapdragon 800 (M… | 2013-09-12   | D      |        6 |    0.0001% |
| 1221 | akershus         | ZTE            | Axon 9 Pro                | Snapdragon 845 (S… | 2018-11-01   | O      |        6 |    0.0001% |
| 1221 | Z00D             | ASUS           | Zenfone 2 (ZE500CL)       | Atom Z2560         | 2015-03-01   | D      |        6 |    0.0001% |
| 1221 | G                | 10.or          | G, Tenor G                | Snapdragon 626 (M… | 2017-10-03   | D      |        6 |    0.0001% |
| 1221 | A7010a48         | Lenovo         | VIBE X3 Lite, A7010       | MediaTek MT6753    | 2015-12-01   | U      |        6 |    0.0001% |
| 1238 | vidofnir         | Volla Phone    | X23 (Gigaset GX4)         | Helio G99          | 2023-05-01   | U      |        5 |    0.0001% |
| 1238 | us997            | LG             | G6 (US Unlocked)          | Snapdragon 821 (M… | 2017-02-01   | D      |        5 |    0.0001% |
| 1238 | tenshi           | BQ             | Aquaris U Plus            | Snapdragon 430 (M… | 2016-06-01   | D      |        5 |    0.0001% |
| 1238 | rs988            | LG             | G5 (US Unlocked)          | Snapdragon 820     | 2016-02-01   | D      |        5 |    0.0001% |
| 1238 | radxa0_tab       | Radxa          | Zero (Tablet)             | Amlogic S905Y2     | 2020-12-01   | O      |        5 |    0.0001% |
| 1238 | nx512j           | Nubia          | Z9 Max                    | Snapdragon 615 (M… | 2015-06-01   | D      |        5 |    0.0001% |
| 1238 | maverick         | Amazon         | Fire HD 10 9th gen        | Helio P60T (MT818… | 2019-10-01   | U      |        5 |    0.0001% |
| 1238 | krillin          | BQ             | Aquaris E4.5              | MediaTek MT6582    | 2014-06-01   | U      |        5 |    0.0001% |
| 1238 | jackpotlte       | Samsung        | Galaxy A8 2018            | Exynos 7885        | 2018-01-01   | U      |        5 |    0.0001% |
| 1238 | j3xprolte        | Samsung        | Galaxy J3 Pro (SM-J3110,… | Spreadtrum SC9830i | 2016-06-01   | U      |        5 |    0.0001% |
| 1238 | iris             | ZTE            | Grand S Flex              | Snapdragon 400 (M… | 2013-11-01   | U      |        5 |    0.0001% |
| 1238 | h811             | LG             | G4 (T-Mobile)             | Snapdragon 808     | 2015-06-01   | D      |        5 |    0.0001% |
| 1238 | d2vzw            | Samsung        | Galaxy S III (Verizon)    | Snapdragon S4 Plu… | 2012-06-28   | D      |        5 |    0.0001% |
| 1238 | caymanslm        | LG             | Velvet                    | Snapdragon 845     | 2020-07-31   | O      |        5 |    0.0001% |
| 1238 | RMX3242          | Realme         | Narzo 30 5G               | Dimensity 700      | 2021-06-24   | U      |        5 |    0.0001% |
| 1253 | vs985            | LG             | G3 (Verizon)              | Snapdragon 801 (M… | 2014-06-01   | D      |        4 |   0.00009% |
| 1253 | v1               | Motorola       | Moto G5 Plus (XT1687)     | Snapdragon 625 MS… | 2017-04-01   | U      |        4 |   0.00009% |
| 1253 | surfna           | Motorola       | Moto E6                   | Snapdragon 435 (M… | 2019-08-01   | U      |        4 |   0.00009% |
| 1253 | serranolteusc    | Samsung        | Galaxy S4 Mini (SCH-R890) | Snapdragon 400     | 2013-07-01   | U      |        4 |   0.00009% |
| 1253 | sabrina          | Google         | Chromecast with Google T… | Amlogic S905D3G    | 2020-09-01   | O      |        4 |   0.00009% |
| 1253 | odroidc4_tab     | HardKernel     | ODROID-C4 (Tablet)        | Amlogic S905X3     | 2020-12-01   | O      |        4 |   0.00009% |
| 1253 | kinzie           | Motorola       | DROID Turbo 2             | Snapdragon 810     | 2015-10-01   | U      |        4 |   0.00009% |
| 1253 | j7ltechn         | Samsung        | Galaxy J7 (SM-J7008)      | Snapdragon 615     | 2015-06-01   | U      |        4 |   0.00009% |
| 1253 | j5ltexx          | Samsung        | Galaxy J5 (SM-J5007/F/G/… | Snapdragon 410     | 2015-07-28   | U      |        4 |   0.00009% |
| 1253 | j3xltebmc        | Samsung        | Galaxy J3 (2016) (SM-J32… | Snapdragon 410     | 2016-05-01   | U      |        4 |   0.00009% |
| 1253 | d838             | LG             | G Pro2 (LG-D838)          | Snapdragon 800     | 2014-02-21   | U      |        4 |   0.00009% |
| 1253 | chaozu           | BQ             | Aquaris U                 | Snapdragon 430 (M… | 2016-06-01   | D      |        4 |   0.00009% |
| 1253 | cas              | Xiaomi         | Mi 10 Ultra               | Snapdragon 865 5G… | 2020-08-16   | U      |        4 |   0.00009% |
| 1253 | agate            | Xiaomi         | 11T                       | Dimensity 1200-Ul… | 2021-10-05   | U      |        4 |   0.00009% |
| 1253 | Z008             | ASUS           | Zenfone 2 (720p)          | Atom Z3560         | 2015-03-01   | D      |        4 |   0.00009% |
| 1253 | NX679J           | Nubia          | RedMagic 7 5G (NX679J)    | Snapdragon 8 Gen 1 | 2022-02-01   | U      |        4 |   0.00009% |
| 1269 | x1slte           | Gionee         | X1S                       | MediaTek MT6737T   | 2017-09-01   | U      |        3 |   0.00007% |
| 1269 | vee7             | LG             | Optimus L7 II (vee7e), L… | Snapdragon S4 Pla… | 2013-03-01   | U      |        3 |   0.00007% |
| 1269 | umts_spyder      | Motorola       | DROID RAZR (GSM), DROID … | OMAP 4430          | 2011-11-11   | D      |        3 |   0.00007% |
| 1269 | sf340n           | LG             | Stylo 3 Plus              | Snapdragon 435     | 2017-05-01   | U      |        3 |   0.00007% |
| 1269 | r5               | OPPO           | R5 (International), R5s … | Snapdragon 615     | 2014-12-01   | D      |        3 |   0.00007% |
| 1269 | p839v55          | Vodafona       | Smart ultra 6             | Snapdragon 615 (M… | 2015-07-01   | U      |        3 |   0.00007% |
| 1269 | nx589j           | Nubia          | Z17 mini S (NX589J)       | Snapdragon 653     | 2017-10-19   | U      |        3 |   0.00007% |
| 1269 | nemo             | LG             | Watch Urbane 2nd Edition… | Snapdragon 400     | 2016-03-01   | U      |        3 |   0.00007% |
| 1269 | logan            | Samsung        | Galaxy Ace3  (GT-S7270, … | Broadcom BCM21664  | 2013-06-01   | U      |        3 |   0.00007% |
| 1269 | kipper           | Wileyfox       | Storm                     | Snapdragon 615 (M… | 2015-11-01   | D      |        3 |   0.00007% |
| 1269 | himawl           | HTC            | One M9 (Verizon)          | Snapdragon 810 (M… | 2015-03-01   | D      |        3 |   0.00007% |
| 1269 | h96pro           | H96            | Pro Plus                  | Amlogic S912       | 2017-02-01   | U      |        3 |   0.00007% |
| 1269 | ef65             | Pantech        | Vega Pop-Up Note          | Snapdragon 800     | 2014-11-01   | U      |        3 |   0.00007% |
| 1269 | cusco            | Motorola       | edge 50 fusion            | Snapdragon 7s Gen… | 2024-05-01   | U      |        3 |   0.00007% |
| 1269 | X00QD            | ASUS           | ZenFone 5 (ZE620KL)       | Snapdragon 636     | 2018-04-01   | U      |        3 |   0.00007% |
| 1269 | I001D            | ASUS           | ROG Phone 2 (ZS660KL)     | Snapdragon 855+ (… | 2019-09-01   | D      |        3 |   0.00007% |
| 1285 | xt897            | Motorola       | PHOTON Q 4G LTE           | Snapdragon S4 Plu… | 2012-08-19   | D      |        2 |   0.00005% |
| 1285 | trltevzw         | Samsung        | Galaxy Note4 (SM-N910V)   | Snapdragon 805     | 2014-10-01   | U      |        2 |   0.00005% |
| 1285 | tomato           | YU             | Yureka, Yureka Plus       | Snapdragon 615 (M… | 2014-12-18   | D      |        2 |   0.00005% |
| 1285 | sydney           | Huawei         | Nova 3i Sydney            | Kirin 710          | 2018-07-27   | U      |        2 |   0.00005% |
| 1285 | style3lm         | LG             | Style3                    | Snapdragon 845 (S… | 2020-06-25   | O      |        2 |   0.00005% |
| 1285 | radxa02          | Radxa          | Zero 2 (Android TV)       | Amlogic S905D3     | 2022-12-01   | O      |        2 |   0.00005% |
| 1285 | peach            | ARK            | Benefit A3                | Snapdragon 410 (M… | 2015-07-01   | D      |        2 |   0.00005% |
| 1285 | m7vzw            | HTC            | One (Verizon)             | Snapdragon 600 (A… | 2013-03-01   | D      |        2 |   0.00005% |
| 1285 | m216             | LG             | K10                       | Snapdragon 410 (M… | 2016-01-01   | D      |        2 |   0.00005% |
| 1285 | lettuce          | YU             | Yuphoria                  | Snapdragon 410 (M… | 2015-05-12   | D      |        2 |   0.00005% |
| 1285 | kltesprsports    | Samsung        | Galaxy S5 Sport           | Snapdragon 801 (M… | 2014-06-23   | D      |        2 |   0.00005% |
| 1285 | j5xn3g           | Samsung        | Galaxy J5 (2016)          | Snapdragon 410 (M… | 2016-04-01   | U      |        2 |   0.00005% |
| 1285 | j3ltekx          | Samsung        | Galaxy J3 (2016) (SM-J32… | Snapdragon 410 MS… | 2016-05-06   | U      |        2 |   0.00005% |
| 1285 | h810_usu         | LG             | G4 (LG-H810)              | Snapdragon 808     | 2015-04-01   | U      |        2 |   0.00005% |
| 1285 | fortuna3gdtv     | Samsung        | Galaxy Grand Prime (SM-G… | Snapdragon 410     | 2014-10-01   | U      |        2 |   0.00005% |
| 1285 | d803             | LG             | G2 (Canadian)             | Snapdragon 800 (M… | 2013-09-12   | D      |        2 |   0.00005% |
| 1285 | bkav_b60         | BKAV           | Bphone B60                | Snapdragon 660     | 2020-05-01   | U      |        2 |   0.00005% |
| 1285 | Z00RD            | ASUS           | ZenFone 2 Laser (ZE500KG) | Snapdragon 410     | 2015-08-01   | U      |        2 |   0.00005% |
| 1285 | X5_Max_Pro       | Doogee         | X5 Max Pro                | MediaTek MT6737    | 2016-06-01   | U      |        2 |   0.00005% |
| 1285 | Samsung Galaxy … | Samsung        | Galaxy S8 Plus (SM-G955F) | Exynos 8895        | 2017-04-21   | U      |        2 |   0.00005% |
| 1285 | GS290            | Gigaset        | GS290                     | Helio P22 (MT6762) | 2019-11-01   | U      |        2 |   0.00005% |
| 1306 | spyder           | Motorola       | DROID RAZR (CDMA), DROID… | OMAP 4430          | 2011-11-11   | D      |        1 |   0.00002% |
| 1306 | shamu_t          | Motorola       | Moto X Pro (China)        | Snapdragon 805     | 2015-01-01   | U      |        1 |   0.00002% |
| 1306 | seed             | Google         | Android One 2nd Gen       | Snapdragon 410 (M… | 2015-07-01   | D      |        1 |   0.00002% |
| 1306 | quill_tab        | NVIDIA         | Jetson TX2 [Tablet], Jet… | Tegra X2 (T186)    | 2017-03-14   | O      |        1 |   0.00002% |
| 1306 | mt2              | Huawei         | Ascend Mate 2 4G          | Snapdragon 400 (M… | 2014-01-01   | D      |        1 |   0.00002% |
| 1306 | k11ta_a          | ulefone        | Future                    | Helio P10 (MT6755) | 2016-05-01   | U      |        1 |   0.00002% |
| 1306 | j7toplteskt      | Samsung        | Galaxy Wide3              | Exynos 7870        | 2018-05-01   | U      |        1 |   0.00002% |
| 1306 | idol4            | Alcatel        | Idol 4 (6055A)            | Snapdragon 617     | 2016-06-01   | U      |        1 |   0.00002% |
| 1306 | e5lte            | Samsung        | Galaxy E5 (SM-E500F/M)    | Snapdragon 410     | 2015-01-01   | U      |        1 |   0.00002% |
| 1306 | d2refreshspr     | Samsung        | Galaxy S III (Sprint)     | Snapdragon S4 Plu… | 2012-06-01   | U      |        1 |   0.00002% |
| 1306 | berkeley         | Huawei         | Honor View 10             | Kirin 970          | 2018-01-01   | D      |        1 |   0.00002% |
| 1306 | a71n             | Samsung        | Galaxy A71                | Snapdragon 730     | 2020-01-01   | U      |        1 |   0.00002% |
| 1306 | RMX3461          | Realme         | 9 5G Speed Edition        | Snapdragon 778G    | 2022-03-01   | U      |        1 |   0.00002% |
| 1306 | Nightmare        |                |                           |                    |              | U      |        1 |   0.00002% |
|      | Unlisted         |                |                           |                    |              |        |     4433 |      0.10% |
|      | Total            |                |                           |                    |              |        |  4264168 |    100.00% |
---------------------------------------------------------------------------------------------------------------------------------------------
Build status codes: O=active official, D=discontinued official, U=unofficial

Manufacturers of devices that run LineageOS
---------------------------------------------------------------------
| Rank |     Maker      | Builds | % Builds | Installs | % Installs |
---------------------------------------------------------------------
| 1    | Samsung        |    411 |    31.2% |  1219799 |     28.61% |
| 2    | Motorola       |    101 |     7.7% |  1142350 |     26.79% |
| 3    | Xiaomi         |    204 |    15.5% |   724221 |     16.98% |
| 4    | OPPO           |     21 |     1.6% |   366201 |      8.59% |
| 5    | Huawei         |     30 |     2.3% |   250638 |      5.88% |
| 6    | virtual        |     12 |     0.9% |   179948 |      4.22% |
| 7    | LG             |     67 |     5.1% |    64830 |      1.52% |
| 8    | Realme         |     33 |     2.5% |    62896 |      1.47% |
| 9    | OnePlus        |     43 |     3.3% |    57482 |      1.35% |
| 10   | Google         |     52 |     3.9% |    49051 |      1.15% |
| 11   | Amazon         |     13 |     1.0% |    39773 |      0.93% |
| 12   | Nintendo       |      3 |     0.2% |    23113 |      0.54% |
| 13   | Sony           |     60 |     4.5% |    15081 |      0.35% |
| 14   | Raspberry Pi   |      3 |     0.2% |    14149 |      0.33% |
| 15   | Lenovo         |     36 |     2.7% |    12415 |      0.29% |
| 16   | Nubia          |     17 |     1.3% |     4123 |      0.10% |
| 17   | ASUS           |     28 |     2.1% |     3753 |      0.09% |
| 18   | LeEco          |      4 |     0.3% |     3720 |      0.09% |
| 19   | Fairphone      |      5 |     0.4% |     3241 |      0.08% |
| 20   | unknown        |     22 |     1.7% |     3057 |      0.07% |
| 21   | ZTE            |      9 |     0.7% |     2261 |      0.05% |
| 22   | HTC            |     21 |     1.6% |     2200 |      0.05% |
| 23   | Nokia          |      8 |     0.6% |     1766 |      0.04% |
| 24   | Nothing        |      5 |     0.4% |     1349 |      0.03% |
| 25   | R36S           |      1 |    0.08% |     1184 |      0.03% |
| 26   | NVIDIA         |     10 |     0.8% |     1179 |      0.03% |
| 27   | Smartisan      |      2 |     0.2% |     1151 |      0.03% |
| 28   | HardKernel     |      7 |     0.5% |     1023 |      0.02% |
| 29   | Essential      |      1 |    0.08% |     1010 |      0.02% |
| 30   | Meizu          |      3 |     0.2% |      798 |      0.02% |
| 31   | BQ             |     11 |     0.8% |      678 |      0.02% |
| 32   | GREE           |      1 |    0.08% |      616 |      0.01% |
| 33   | Razer          |      2 |     0.2% |      612 |      0.01% |
| 34   | ZUK            |      3 |     0.2% |      485 |      0.01% |
| 35   | Infinix        |      6 |     0.5% |      408 |     0.010% |
| 36   | Wingtech       |      1 |    0.08% |      347 |     0.008% |
| 37   | Wileyfox       |      3 |     0.2% |      285 |     0.007% |
| 38   | Micromax       |      1 |    0.08% |      213 |     0.005% |
| 39   | F(x)tec        |      2 |     0.2% |      209 |     0.005% |
| 40   | Sharp          |      1 |    0.08% |      143 |     0.003% |
| 41   | Walmart        |      1 |    0.08% |      126 |     0.003% |
| 42   | TECNO          |      4 |     0.3% |      122 |     0.003% |
| 43   | FEITIAN        |      1 |    0.08% |      117 |     0.003% |
| 44   | Pantech        |      6 |     0.5% |      114 |     0.003% |
| 45   | Solana         |      1 |    0.08% |      106 |     0.002% |
| 46   | GPD            |      1 |    0.08% |      105 |     0.002% |
| 47   | Iocean         |      1 |    0.08% |      104 |     0.002% |
| 48   | General Mobile |      3 |     0.2% |       95 |     0.002% |
| 49   | SHIFT          |      1 |    0.08% |       88 |     0.002% |
| 50   | YU             |      4 |     0.3% |       81 |     0.002% |
| 51   | Vsmart         |      1 |    0.08% |       80 |     0.002% |
| 52   | PowKiddy       |      1 |    0.08% |       78 |     0.002% |
| 53   | Chuwi          |      1 |    0.08% |       77 |     0.002% |
| 54   | Dynalink       |      1 |    0.08% |       74 |     0.002% |
| 55   | Nextbit        |      1 |    0.08% |       72 |     0.002% |
| 56   | Radxa          |      3 |     0.2% |       49 |     0.001% |
| 57   | Retroid        |      1 |    0.08% |       47 |     0.001% |
| 58   | C Idea         |      1 |    0.08% |       44 |     0.001% |
| 59   | Itel           |      1 |    0.08% |       42 |    0.0010% |
| 60   | Yandex         |      1 |    0.08% |       40 |    0.0009% |
| 61   | Acer           |      1 |    0.08% |       39 |    0.0009% |
| 62   | Tecno          |      1 |    0.08% |       31 |    0.0007% |
| 63   | H96            |      2 |     0.2% |       23 |    0.0005% |
| 64   | Umidigi        |      1 |    0.08% |       11 |    0.0003% |
| 65   | Alcatel        |      2 |     0.2% |        8 |    0.0002% |
| 66   | JiaYu          |      1 |    0.08% |        7 |    0.0002% |
| 67   | 10.or          |      1 |    0.08% |        6 |    0.0001% |
| 68   | Volla Phone    |      1 |    0.08% |        5 |    0.0001% |
| 69   | Gionee         |      1 |    0.08% |        3 |   0.00007% |
| 70   | BKAV           |      1 |    0.08% |        2 |   0.00005% |
| 71   | ulefone        |      1 |    0.08% |        1 |   0.00002% |
|      | Unlisted       |      ? |        ? |     4433 |      0.10% |
|      | Total          |   1319 |   100.0% |  4264168 |    100.00% |
---------------------------------------------------------------------

Processors of devices that run LineageOS
---------------------------------------------------------------------
| Rank | Processor Type | Builds | % Builds | Installs | % Installs |
---------------------------------------------------------------------
| 1    | Snapdragon 6   |    205 |    15.5% |  1035781 |     24.29% |
| 2    | Exynos         |    164 |    12.4% |  1028688 |     24.12% |
| 3    | Snapdragon 8   |    353 |    26.8% |   602835 |     14.14% |
| 4    | Snapdragon 4   |    184 |    13.9% |   480528 |     11.27% |
| 5    | Snapdragon 7   |     72 |     5.5% |   333909 |      7.83% |
| 6    | Kirin          |     21 |     1.6% |   189616 |      4.45% |
| 7    | X86            |      5 |     0.4% |   156624 |      3.67% |
| 8    | Helio          |     63 |     4.8% |   144760 |      3.39% |
| 9    | Omap           |     10 |     0.8% |    68159 |      1.60% |
| 10   | Dimensity      |     40 |     3.0% |    63114 |      1.48% |
| 11   | Mediatek       |     32 |     2.4% |    42076 |      0.99% |
| 12   | Tegra          |     21 |     1.6% |    28449 |      0.67% |
| 13   | Arm            |      1 |    0.08% |    19890 |      0.47% |
| 14   | Broadcom       |     11 |     0.8% |    15392 |      0.36% |
| 15   | Spreadtrum     |     16 |     1.2% |    11402 |      0.27% |
| 16   | Tensor         |     16 |     1.2% |     9371 |      0.22% |
| 17   | Atom           |     11 |     0.8% |     8867 |      0.21% |
| 18   | Snapdragon S   |     28 |     2.1% |     7542 |      0.18% |
| 19   | unknown        |     21 |     1.6% |     3143 |      0.07% |
| 20   | X86_64         |      5 |     0.4% |     2876 |      0.07% |
| 21   | Qualcomm       |      4 |     0.3% |     1658 |      0.04% |
| 22   | Rockchip       |      3 |     0.2% |     1352 |      0.03% |
| 23   | Amlogic        |     15 |     1.1% |     1156 |      0.03% |
| 24   | Snapdragon 2   |     10 |     0.8% |      829 |      0.02% |
| 25   | Arm64          |      3 |     0.2% |      764 |      0.02% |
| 26   | Novathor       |      1 |    0.08% |      576 |      0.01% |
| 27   | Marvell        |      1 |    0.08% |      208 |     0.005% |
| 28   | Arm32          |      1 |    0.08% |       83 |     0.002% |
| 29   | Snapdragon     |      1 |    0.08% |       44 |     0.001% |
| 30   | Unisoc         |      1 |    0.08% |       43 |     0.001% |
|      | Unlisted       |      ? |        ? |     4433 |      0.10% |
|      | Total          |   1319 |   100.0% |  4264168 |    100.00% |
---------------------------------------------------------------------

Status of LineageOS builds
--------------------------------------------------------------------------------------
|  Status  | Builds | % Builds | Installs | % Installs | Unsupported | % Unsupported |
--------------------------------------------------------------------------------------
| O        |    252 |    19.1% |  1944502 |     45.60% |     1476204 |        34.62% |
| D        |    299 |    22.7% |   114675 |      2.69% |       85723 |         2.01% |
| U        |    768 |    58.2% |  2200558 |     51.61% |     1066898 |        25.02% |
| Unlisted |      ? |        ? |     4433 |      0.10% |             |               |
| Total    |   1319 |   100.0% |  4264168 |    100.00% |     2628825 |        61.65% |
--------------------------------------------------------------------------------------
Build status codes: O=active official, D=discontinued official, U=unofficial
Unsupported = installs of unsupported versions that don't get security updates

LineageOS versions in active installs
---------------------------------------------------------------
| Rank | Version  | Builds | % Builds | Installs | % Installs |
---------------------------------------------------------------
| 1    | 18.1     |    594 |      45% |  1091712 |     25.60% |
| 2    | 21.0     |    539 |      41% |   940686 |     22.06% |
| 3    | 17.1     |    502 |      38% |   824752 |     19.34% |
| 4    | 20.0     |    530 |      40% |   478691 |     11.23% |
| 5    | 19.1     |    415 |      31% |   465149 |     10.91% |
| 6    | 22.2     |    446 |      34% |   155070 |      3.64% |
| 7    | 14.1     |    409 |      31% |    87995 |      2.06% |
| 8    | 15.1     |    286 |      22% |    62825 |      1.47% |
| 9    | 16.0     |    532 |      40% |    48667 |      1.14% |
| 10   | 23.0     |    279 |      21% |    39014 |      0.91% |
| 11   | 17.0     |     87 |       7% |    25421 |      0.60% |
| 12   | 22.1     |    338 |      26% |    13819 |      0.32% |
| 13   | 18.0     |     90 |       7% |     9916 |      0.23% |
| 14   | 13.0     |    150 |      11% |     8458 |      0.20% |
| 15   | 12.1     |      7 |     0.5% |     1873 |      0.04% |
| 16   | 22.0     |    118 |       9% |     1808 |      0.04% |
| 17   | 20.3     |      1 |    0.08% |     1789 |      0.04% |
| 18   | 19.0     |    115 |       9% |     1755 |      0.04% |
| 19   | 10.0     |     25 |       2% |      193 |     0.005% |
| 20   | 16.1     |      2 |     0.2% |       73 |     0.002% |
| 21   | 15.0     |      3 |     0.2% |       21 |    0.0005% |
| 22   | 20.2     |      2 |     0.2% |       17 |    0.0004% |
| 23   | 15.2     |      1 |    0.08% |       10 |    0.0002% |
| 24   | 24.0     |      1 |    0.08% |        9 |    0.0002% |
| 25   | 25.0     |      1 |    0.08% |        4 |   0.00009% |
| 26   | 14.0     |      2 |     0.2% |        2 |   0.00005% |
| 27   | 21.3     |      1 |    0.08% |        1 |   0.00002% |
|      | Unlisted |      ? |        ? |     4433 |      0.10% |
|      | Total    |   1319 |     100% |  4264168 |    100.00% |
---------------------------------------------------------------

Years when devices running LineageOS were released
-------------------------------------------------------------------
|   Year   |  Status  | Builds | % Builds | Installs | % Installs |
-------------------------------------------------------------------
| 2011     | O        |      0 |       0% |        0 |         0% |
| 2011     | D        |      5 |     0.4% |      558 |      0.01% |
| 2011     | U        |      4 |     0.3% |      250 |     0.006% |
| 2011     | Total    |      9 |     0.7% |      808 |      0.02% |
| 2012     | O        |      0 |       0% |        0 |         0% |
| 2012     | D        |     16 |     1.2% |    11658 |      0.27% |
| 2012     | U        |     14 |     1.1% |    81550 |      1.91% |
| 2012     | Total    |     30 |     2.3% |    93208 |      2.19% |
| 2013     | O        |      0 |       0% |        0 |         0% |
| 2013     | D        |     45 |     3.4% |    30980 |      0.73% |
| 2013     | U        |     41 |     3.1% |    13925 |      0.33% |
| 2013     | Total    |     86 |     6.5% |    44905 |      1.05% |
| 2014     | O        |      0 |       0% |        0 |         0% |
| 2014     | D        |     63 |     4.8% |    26296 |      0.62% |
| 2014     | U        |     79 |     6.0% |    41165 |      0.97% |
| 2014     | Total    |    142 |    10.8% |    67461 |      1.58% |
| 2015     | O        |      2 |     0.2% |      573 |      0.01% |
| 2015     | D        |     55 |     4.2% |    43213 |      1.01% |
| 2015     | U        |     80 |     6.1% |    28141 |      0.66% |
| 2015     | Total    |    137 |    10.4% |    71927 |      1.69% |
| 2016     | O        |      6 |     0.5% |    15377 |      0.36% |
| 2016     | D        |     49 |     3.7% |   214581 |      5.03% |
| 2016     | U        |     73 |     5.5% |   162479 |      3.81% |
| 2016     | Total    |    128 |     9.7% |   392437 |      9.20% |
| 2017     | O        |     18 |     1.4% |   133895 |      3.14% |
| 2017     | D        |     18 |     1.4% |    28671 |      0.67% |
| 2017     | U        |     77 |     5.8% |   359039 |      8.42% |
| 2017     | Total    |    113 |     8.6% |   521605 |     12.23% |
| 2018     | O        |     33 |     2.5% |   359749 |      8.44% |
| 2018     | D        |     26 |     2.0% |    33237 |      0.78% |
| 2018     | U        |     57 |     4.3% |   428083 |     10.04% |
| 2018     | Total    |    116 |     8.8% |   821069 |     19.26% |
| 2019     | O        |     44 |     3.3% |  1323380 |     31.03% |
| 2019     | D        |     12 |     0.9% |    21145 |      0.50% |
| 2019     | U        |     71 |     5.4% |   369611 |      8.67% |
| 2019     | Total    |    127 |     9.6% |  1714136 |     40.20% |
| 2020     | O        |     46 |     3.5% |   172885 |      4.05% |
| 2020     | D        |      9 |     0.7% |     7083 |      0.17% |
| 2020     | U        |     61 |     4.6% |    75467 |      1.77% |
| 2020     | Total    |    116 |     8.8% |   255435 |      5.99% |
| 2021     | O        |     39 |     3.0% |    40268 |      0.94% |
| 2021     | D        |      1 |    0.08% |       69 |     0.002% |
| 2021     | U        |     47 |     3.6% |   176808 |      4.15% |
| 2021     | Total    |     87 |     6.6% |   217145 |      5.09% |
| 2022     | O        |     31 |     2.4% |    11793 |      0.28% |
| 2022     | D        |      0 |       0% |        0 |         0% |
| 2022     | U        |     52 |     3.9% |     6879 |      0.16% |
| 2022     | Total    |     83 |     6.3% |    18672 |      0.44% |
| 2023     | O        |     22 |     1.7% |    11638 |      0.27% |
| 2023     | D        |      0 |       0% |        0 |         0% |
| 2023     | U        |     48 |     3.6% |     9835 |      0.23% |
| 2023     | Total    |     70 |     5.3% |    21473 |      0.50% |
| 2024     | O        |      9 |     0.7% |     3112 |      0.07% |
| 2024     | D        |      0 |       0% |        0 |         0% |
| 2024     | U        |     21 |     1.6% |     2053 |      0.05% |
| 2024     | Total    |     30 |     2.3% |     5165 |      0.12% |
| 2025     | O        |      2 |     0.2% |      259 |     0.006% |
| 2025     | D        |      0 |       0% |        0 |         0% |
| 2025     | U        |     10 |     0.8% |     2170 |      0.05% |
| 2025     | Total    |     12 |     0.9% |     2429 |      0.06% |
| unknown  | U        |     33 |     2.5% |    11860 |      0.28% |
| unknown  | Total    |     33 |     2.5% |    11860 |      0.28% |
| Unlisted | Unlisted |      ? |        ? |     4433 |      0.10% |
| Total    | Total    |   1319 |     100% |  4264168 |       100% |
-------------------------------------------------------------------

Reported on Saturday 15 Nov 2025 00:58:55 -04.
Script execution time = 17 minutes 17 seconds
```
