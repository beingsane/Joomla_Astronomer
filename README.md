# Joomla Astronomer ![Logo](https://cloud.githubusercontent.com/assets/1850089/15307103/a30ff9a6-1b95-11e6-9c8d-6fff4074e06c.png)
Joomla Astronomer will be a extension / group of extensions for Astronomy research and observation.


It consists of several parts...<br>
+1) astrometry forms, & views..<br>
+2) Comet forms & views<br>
+3) mod_julian_clock - [#*DONE*#](https://github.com/N6REJ/mod_julianclock/releases/tag/1.6)<br>
+4) use profile plugin to add observer specific info to the joomla user profiles. - [#*DONE*#](https://github.com/N6REJ/Joomla_Astronomer/issues/2)<br>
+5) light curve graphs.<br>
+6) plugin for performing searchs on the entries.<br>

The main component com_joomla_astronomer forms the heart of the system.  It will supply all the views and form handling.
It will be supported by several plugins and modules.  That will work together as a system.

### Reason for this Package.
[Arkansas Sky Observatory](http://arksky.org) has been donating their services to the astronomy world for decades.  They get zero funding from any source
other then Doc Clays personal retirement.  Their original site was designed in perl back in 2001 and most of the code used
is either obsolete already, or will soon be with the advent of php 7.  They suffered a major data loss a few years ago and have
not been able to rebuild due to the numerous issues.  Everything up to now has either been in flat files, or in a 
mixture of formats.
ASO provides a lot of important data back to major centers like Harvard and Minor Planet so I would like to help
them be strong once again.

#1 - Astrometry section information
The astrometry function will need to consist of 3 parts.<br>
1) the entry form which takes only string characters.  It should look similar to this.. <img src="https://cloud.githubusercontent.com/assets/1850089/15264556/e524b5f6-1939-11e6-8cc6-d525cff37497.JPG" width="23%"></img><br>
2) The search form which needs only date , observatory or designation to search on.  Can be any or all of these.  It should look like this.. <img src="https://cloud.githubusercontent.com/assets/1850089/15264497/37d8c400-1939-11e6-8467-72c7d1bee0b7.JPG" width="23%"></img><br>
3) A search output view where the user is able to copy the search return AS PURE ASCII!  a header and footer string is required but their needs to be a button or some other method to give the user the search output.

I've created a conversion system to take ASO's old data and turn it into a useable csv to preserve their 12yrs of observations.
part of this conversion includes some validation checks that will need to be performed after they've hit submit ( or via ajax ) but BEFORE its put into the DB.  
A optional( for now ) validation curl check consisting of () as shown HERE will be performed on the submssions.
[MPC Astrometry Data Exchange Standard](http://minorplanetcenter.net/iau/info/IAU2015_ADES.pdf) explains in detail what needs to be where and why. [MPC Format For Optical Astrometric Observations Of Comets, Minor Planets and Natural Satellites](http://www.minorplanetcenter.net/iau/info/OpticalObs.html) contains a more concise breakdown view.
Section 4.3 of the MPC ASDES as given above, describes in detail what the header must be and is required for the automated processing functions and should be included in the search output.  This data is currently held as one of 4 user fields by the plugin.

#2 - Comets section information... <img src="https://cloud.githubusercontent.com/assets/1850089/15342751/71e86a5c-1c5d-11e6-883b-0a9f127b5f67.png" width="23%" /><br>
The comets branch will be "comets" it will contain the conversion system for the comets data.
and forms, list views.  ( See image gallery )

### Files...
the file "comets-seen.csv" is the original csv from which we are starting.  It has several problems.
"observations-date.php" is a converter that takes the "comets-seen.csv" and turns it into a more useable .csv with correct headers and data.
"rebuilt-observations.csv" is the generated output.  I believe the double quotes created by line
84 of "observations-date.php" can be bypassed but in using the .csv to sql converter online It's had to 
be there to get a valid readout.

### Field notes...
The *image* field should be a media manager image.
*Observer* field should be users "name" as known in astrological world.  ( probably not the same as real name or user name ) ( perhaps a automatic alias?)
the *location* should be from a specified list of observatories.
*Comments* should probably be a editor field.
*timestamp* should be a automatic time of the data entered in ( Astronomy format is YYYYMMDD HH )
*date* should be a calendar field ( we might be able to remove it later - but its inference is the actual date of the observation )
I'm not sure of the validation of other fields at this time, nor their max length but I will try to gather that info.


### Usage
The component needs to generate at least 3 views.

+1) a *last Observed* listing of every comet observed and should be filterable.  Sortable by date or comet is important.  Might be nice to have a *total* column for the count of all observations of that comet
![last observed](https://cloud.githubusercontent.com/assets/1850089/14944082/3776b03c-0faf-11e6-8c4f-285ee5bb141c.JPG)

+2) a listing of each observation by comet.
![single comet observations list](https://cloud.githubusercontent.com/assets/1850089/14944083/3779a0c6-0faf-11e6-8af2-bcdb3c76fb0d.JPG)

+3) Single entry view with full size image.
- no current ability - 

ability to have a gallery of observation images might be nice with link back or modal to the entry.


#3 - mod_julian_clock
The julian clock is already completed and is located [here](https://github.com/N6REJ/mod_julianclock)

#4 - Profile plugin
This will be derived from the existing joomla profile plugin.  It will consist of just a few fields.

*UserID* - Derived from the Joomla users tables.  And will be the user filling out the form, ALWAYS!
This is to link the profile to the Joomla user table.

*UserObserverName* **REQUIRED** - This is the Name that the user is known by and is used as the entry form default.

*UserObservatory* **REQUIRED** - This is a official 3 character designator for their particular observatory.
This saves time on form entry and is used for the entry form defaults.

*UserHeader* **REQUIRED** - This is the official header required for astrometry listings.

*UserScope* **REQUIRED** - This is the default scope used for observations.  This saves time on form entry and is used for the entry form default.

#5 - Light Curve Graph
The light curve graph will take astrometry data from 3 fields...<br>
**Mag**<br>
**Designation**<br>
**HumanDate**<br>

+The **Mag** field is a measurement of the objects magnitude and is in nn.n . It is always 2 digits and a decimal.  It is derived from the entry itself.
+The **Designation** field contains the actual objects MPC designation.  And is the title of the curve.
+The **HumanDate** field contains a EXACT date/time of the observation entry, accurate to .00001 .
This time field will be used to give the timing for the graph.  It only needs to be to the minute.

The light curve graph will graph the Brightness change over time in a graph plotted from all the exact data points for any particular object.
This will require searching the designation column for matching designator.
& also getting the Magnitude & time from that same entry.<br>
The *Y* axis denotes Brightness ( Mag )<br>
The *X* axis denotes Time ( HumanDate )<br>
The format for the graph is "light curve"

#6 - Search plugins...
There will be at least 2 search systems.<br>
*1 - Search astrometry data<br>
*2 - Search Comet Data<br>


### Sample Layouts###
<img src="https://cloud.githubusercontent.com/assets/1850089/15264497/37d8c400-1939-11e6-8467-72c7d1bee0b7.JPG" width="23%"></img> <img src="https://cloud.githubusercontent.com/assets/1850089/15264556/e524b5f6-1939-11e6-8cc6-d525cff37497.JPG" width="23%"></img> <img src="https://cloud.githubusercontent.com/assets/1850089/15264557/e525be10-1939-11e6-8d05-1bf31adb199a.JPG" width="23%"></img> <img src="https://cloud.githubusercontent.com/assets/1850089/15264554/e522e348-1939-11e6-8f22-7f36bd88679e.JPG" width="23%"></img> <img src="https://cloud.githubusercontent.com/assets/1850089/15264558/e5262990-1939-11e6-8706-cf64d0f050f8.JPG" width="23%"></img> <img src="https://cloud.githubusercontent.com/assets/1850089/15264555/e524a728-1939-11e6-899e-bc9bcb926081.JPG" width="23%"></img> 

###CRITICAL ITEMS.
anyone can view the entries, but only specified users can enter data.  To simplify matters the image folder used should be restricted to ONLY the one allowed...
for example... 
*/images/observations/comets* would be the root and then each comet would be a sub-folder using the name of the comet I guess...
so when they go to enter a image for comet *104P Kowal* it would automatically put the image in the */images/observations/comets/104P-Kowal* folder.
This forced location of images is not mandatory but would be helpful.  Possibility for duplicate image names does exist but is remote.

**Entry** field is a **RAW** text field that contains the observation.  **It's format is vital!**
All spaces MUST be retained and displayed.

##Official Site##
[ArkSky.org](http://arksky.org)<br>
[Facebook Page](https://www.facebook.com/groups/421163751426836/)

Volunteers to develop this system will be embraced :D
