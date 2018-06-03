Settings Factory for ProcessWire CMS
=======================

Create unlimited settings pages!

- Alpha status - waiting for more tests

- Now supports WireTabs - see the example!

- Testers and code quality checks needed!


## Instructions

1. Create a page under Admin (at the top level or under Setup if you prefer)

2. Save the page and then choose the ProcessSettingsFactory process from the dropdown.

3. Enter the path to your settings file.

## How to use
1. Copy [kitchen-sink.json](https://github.com/outflux3/SettingsFactory/blob/master/samples/kitchen-sink.json) from one of the provided examples to your template folder (or anywhere within your template folder)

2. Add the following to your functions.php or whatever it is you use to set up your PW site
```
$settings = $modules->get("SettingsFactory");
$siteSettings = $settings->getSettings('kitchen-sink');
```

3. Use it in your template as follows, where `text1` refers to a key in your settings
```
<php echo $siteSettings['text1']; ?>
```

4. Feel free to edit your JSON file to your liking/usage

## Support
coming soon


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
