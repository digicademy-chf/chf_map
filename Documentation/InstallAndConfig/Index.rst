..  include:: /Includes.rst.txt

..  _install-and-config:

==================
Install and config
==================

..  rst-class:: bignums

1.  Install the extension

    Add the package name to your ``composer.json`` or install the package
    manually.

2.  Set up a data folder

    In a blank folder in your page tree, add a ``MapResource``. Further data,
    such as features, needs to be located in the same data folder. Depending
    on the size of your resources, you may want to reserve a data folder per
    resource to keep their records separate.

..  _display-the-resource:

====================
Display the resource
====================

To show the map resource on a specific page of your website, simply add the
:guilabel:`Map` plugin and set it up to use the resource in question.

If you want to be able to only show select features from your resource, use
the label function built into the extension. You can add a ``Tag`` of type
:guilabel:`Label` to your data folder and then select it in the features you
want it to apply to. You can then select the label in the plugin to display
only those features.

..  attention::

    The extension does not currently include a generic frontend template.

    TBD
