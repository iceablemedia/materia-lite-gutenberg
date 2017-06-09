module.exports = function(grunt) {

  require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        sourceMap: false,
        outputStyle: 'expanded',
      },
      dist: {
        files: {
          'assets/css/materia.dev.css': 'assets/scss/materia.scss',
          'assets/css/materia-unresponsive.dev.css': 'assets/scss/materia-unresponsive.scss',
        }
      }
    },

    postcss: {
      options: {
        processors: [
          require('autoprefixer')({browsers: 'last 2 versions'}),
        ]
      },
      dist: {
        src: 'assets/css/*.dev.css'
      }
    },

    csscomb: {
      dist: {
        options: {
          config: 'assets/css/csscomb.json'
        },
        files: {
          'css/materia.dev.css': 'assets/css/materia.dev.css',
          'css/materia-unresponsive.dev.css': 'assets/css/materia-unresponsive.dev.css',
        }
      }
    },

    cssmin: {
      options: {
        shorthandCompacting: false,
        roundingPrecision: -1
      },
      target: {
        files: {
          'css/materia.min.css': 'css/materia.dev.css',
          'css/materia-unresponsive.min.css': 'css/materia-unresponsive.dev.css',
        }
      }
    },

    clean: ['assets/css/*.css'],

    jshint: {
      files: ['Gruntfile.js', 'assets/js/materia.js'],
      options: {
        globals: {
          jQuery: true
        }
      }
    },

    concat: {
     options: {
      separator: '\n\n',
     },
     dist: {
      src: [
        'assets/js/materia.js',
        'assets/js/jquery.hoverIntent.js',
        'assets/js/superfish.js',
      ],
      dest: 'js/materia.dev.js',
     },
    },

    uglify: {
      build: {
        src: 'js/materia.dev.js',
        dest: 'js/materia.min.js'
      }
    },

    makepot: {
      target: {
        options: {
          domainPath: '/languages/',
          potFilename: 'materia-pro.pot',
          type: 'wp-theme'
        }
      }
    },

    watch: {
        scss: {
            files: ['assets/scss/*.scss'],
            tasks: ['sass', 'postcss', 'csscomb', 'cssmin', 'clean'],
            options: {
              interrupt: true,
            },
          },
        js: {
            files: ['assets/js/*.js'],
            tasks: ['jshint', 'concat', 'uglify'],
            options: {
              interrupt: true,
            },
          },
        pot: {
            files: ['*.php', '**/*.php', '**/**/*.php'],
            tasks: ['makepot'],
            options: {
              interrupt: true,
            },
          }
    },


});

grunt.registerTask('default', ['sass', 'postcss', 'csscomb', 'cssmin', 'clean', 'jshint', 'concat', 'uglify', 'makepot']);

};
