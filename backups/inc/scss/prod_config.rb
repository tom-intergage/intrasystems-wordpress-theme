# Compass is a great cross-platform tool for compiling SASS. 
# This compass config file will allow you to 
# quickly dive right in.
# For more info about compass + SASS: http://net.tutsplus.com/tutorials/html-css-techniques/using-compass-and-sass-for-css-in-your-next-project/


#########
# 1. Set this to the root of your project when deployed:
http_path = "/"

# 2. probably don't need to touch these
css_dir = "../css"
sass_dir = "./"
images_dir = "../images"
javascripts_dir = "../js"

# PRODUCTION environment = :production - CHANGE TO environment = :development if DEV
environment = :production

relative_assets = true

# PRODUCTION sourcemap = false - COMMENT IF DEV
sourcemap = false

# 3. You can select your preferred output style here (can be overridden via the command line):
# PRODUCTION output_style :compressed - CHANGE TO output_style = :expanded IF DEV
output_style = :compressed


# PRODUCTION (line_comments = false) uncommented - IF DEV commented
 line_comments = false

# don't touch this
preferred_syntax = :scss