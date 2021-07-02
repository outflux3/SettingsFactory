Settings Factory for ProcessWire CMS
=======================

### Create unlimited settings pages!

• Ever wanted to build some functionality for a site, but need some user editable settings, and don't want to add new fields, and don't want to build a module?  Maybe you are building a service that pulls data from an external site and need to have a place to store some items like URL, or preferences settings.

• Need a place to enter some data to be used for site schema (schema.org), and want an easy way to provide access to those settings panels right from the PW admin menu?

• Need to be able to reuse the same settings panels on various sites without having to create fields?

Settings Factory is your answer!

## Instructions

1. Create a page under Admin (at the top level or under Setup if you prefer), e.g. "Weather Widget".

2. Save the page and then choose **ProcessSettingsFactory** process from the dropdown.

3. Enter the path to your settings definition file* – the path is relative to the templates folder, e.g. "settings/weather-widget.json" (no preceding slash). 
To get started you can use one of the sample schema files provided with the module.

Settings definition files are simply JSON or PHP files that define your inputfields, using any core or site inputfield. The syntax is the same as what you would use to define settings for a module. 

Note that since the settings are accessed using the *page name* of the admin process page, it is recommended that you name them something that will make sense when accessing them from the API.

## How to use on front end

1. Make sure your settings panel works without errors in the admin, and populate the various fields, and save. The data is saved in the Settings Factory module config.

2. Init the module on the front end by setting up a variable to access your settings. Something like this:

```
$factory = $modules->get("SettingsFactory");
$siteSettings = $factory->getSettings('name-of-my-settings');
```
*note that the name of your setting matches the name of the process page, so if you named your process page "weather-widget", then your settings would be called like this:*

```
$factory = $modules->get("SettingsFactory");
$wSettings = $factory->getSettings('weather-widget');
```

3. Use it in your template as follows, where `text1` refers to a key in your settings
```
<php echo $wSettings->text1; ?>
```

the settings are delivered as a WireArray, or can be delivered as a plain array using the getSettingsArray() method, like:

```
getSettingsArray('name-of-process); 
```

## Support

https://processwire.com/talk/topic/17536-settings-factory/


## License

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

(See included LICENSE file for full license text.)
