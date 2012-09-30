Joomla API Plugins - [Uses com_api](https://github.com/rcorral/com_api)
================================

Dependencies
------------------------
* Joomla! 2.5
* [com_api](https://github.com/rcorral/com_api/tree/master) for Joomla 2.5


What is it?
---------------------------------------
A repository of Joomla! plugins that rely on the Joomla! API component.
These plugins are meant to be used as a base start for projects that use com_api as well as examples on how to create plugins for other Joomla! extensions.

Goals
--------------

The following are the goals of the project:

* **`Core extensions`**: This repository will maintain a base plugin for each extension that is part of the Joomla CMS.

* **`Examples`**: Any of these plugins may be used as examples for developers to create their own.

If you want to make it better
-----------------------------
Please feel free to make suggestions for ways to make plugins better and more robust.
Fork and make a pull request.

How do I use it?
-----------------------------
There are a few ways you can install this on your site.

**`Phing`**: If you don't have Phing installed, get it *[here](http://phing.info/trac/)*.  
This script assumes that you have [com_api](https://github.com/rcorral/com_api/tree/master) checked out on the parent directory.
It will create a package of the component with all of the plugins:

	phing -f phing/build.xml
	
That should create a folder at phing/packages with an installable zip.

**`Symbolic Link`**: On a *NIX system, run the following command from the repository root:

	./scripts/symlink.sh
	
It will then ask you for the full path to your site root.  You will then need to use the Discovery mode in Joomla Extension Manager to find the new plugins and install them.

**`Manual Install`**: This is the same concept as using the symlink, except you'll need to copy the plugin files to your site (or run your site from within the "code" folder) and then use the Discovery mode in Joomla Extension Manager.

Roadmap
-----------------------------
- Plugin SEF URL's
- Modify phing script to either package all plugins separately or with the component.

