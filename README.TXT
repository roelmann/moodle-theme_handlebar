THEME_Handlebar
===============

Theme_Handlebar is a child theme of Moodle's new core theme Boost.

It is built on Bootstrap4 and Mustache templates.

In addition to Boost's preset settings, Handlebar adds:

1. Presets - presets added by ftp/ssh to the theme/scss/presets folder will
be automatically added to the presets drop down, in addition to those uploaded
via the user interface.
2. Colours - additional brand colour pickers to fine tune the selected presets,
along with the standard pre/post raw scss custom settings.
3. Content - a footnote setting to add standard content into the footer space
4. Heading and images - add a page background image and a default heading background
image - the heading image can be overridden at a course level by adding an image
banner to the course summary files. A separate login page background image can also
be added.
5. Social networking icons - a panel of social icons can be created, including self-
defined icons.

Also, Handlebar is designed to utilise additional block regions - a TopBar region
which will host blocks horizontally and [COMING SOON] several block region 'pages'
which will pull out as sliders rather than occupy space on the main page.

NOTE: github MASTER is for development purposes - always use STABLE branches in production

Richard

CHANGELOG
---------
3.5.1.0         Add Privacy api
                Make stable for 3.5 new Boost version
3.5.0.0         Rework theme for Moodle3.5
3.4.0.0         Secure url settings with PARAM_URL
                Adapt links for new user/participant page
3.3.1.1         Bug fixes - progress radial
                Rationalise moodle.scss
3.3.1.0         STABLE RELEASE
                Settings added to create student and staff links on pop up pages
                Staff pop up page to replace course editing cog on main course page
                Student pop up page to give course info - course summary/staff
3.3.0.1         Add Turn Editing On button
                Improve course images on myOverview
3.3.0.0         Clone of Waxed
                Added new TopBar custom block region
