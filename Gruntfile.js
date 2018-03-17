module.exports = function(grunt) {
  // Project configuration.
  grunt.initConfig({
    copy: {
      js: {
        files: [{
            expand: true,
            cwd: 'node_modules/jquery/dist',
            src: 'jquery.js',
            dest: 'static/tmp/js'
          },
          {
            expand: true,
            cwd: 'node_modules/bootstrap/dist/js',
            src: 'bootstrap.bundle.js',
            dest: 'static/tmp/js'
          },
          {
              expand: true,
              cwd: 'node_modules/datatables.net-bs4/js',
              src: '*.js',
              dest: 'static/tmp/js'
          },
          {
              expand: true,
              cwd: 'node_modules/datatables.net/js',
              src: '*.js',
              dest: 'static/tmp/js'
          },
          {
              expand: true,
              cwd: 'node_modules/chart.js/dist',
              src: 'Chart.js',
              dest: 'static/tmp/js'
          },
          {
              expand: true,
              cwd: 'node_modules/jquery.easing',
              src: 'jquery.easing.js',
              dest: 'static/tmp/js'
          }
        ]
      },
      css: {
        files: [{
            expand: true,
            cwd: 'node_modules/bootstrap/dist/css',
            src: 'bootstrap.css',
            dest: 'static/tmp/css'
          },
          {
            expand: true,
            cwd: 'node_modules/bootstrap/dist/css',
            src: 'boostrap-theme.css',
            dest: 'static/tmp/css'
          },
          {
              expand: true,
              cwd: 'node_modules/bootstrap/dist/css',
              src: 'boostrap.css.map',
              dest: 'static/tmp/css'
            },
          {
              expand: true,
              cwd: 'node_modules/datatables.net-bs4/css',
              src: '*.css',
              dest: 'static/tmp/css'
          },
          {
              expand: true,
              cwd: 'node_modules/font-awesome/css',
              src: 'font-awesome.css',
              dest: 'static/tmp/css'
          }
        ]
      },
      fonts: {
          files: [{
                expand: true,
                cwd: 'node_modules/font-awesome/fonts',
                src: '*.*',
                dest: 'static/fonts'
            }
          ]
        }
    },
    concat: {
      js: {
//         src: ['static/src/js/jquery.js', 'static/src/js/bootstrap.bundle.js', 'static/src/js/jqBootstrapValidation.js', 'static/src/js/*.js', '!**/*.min.js', '!**/*json*.*', '!**/*topo*.*'],
        src: ['static/tmp/js/jquery.js','static/tmp/js/boostrap.bundle.js','static/tmp/js/jquery.dataTables.js', 'static/tmp/js/*.js', 'static/src/js/*.js'],
        dest: 'static/dist/script.js',
        options: {
          separator: ';\n'
        }
      },
      css: {
        src: ['static/tmp/css/*.css', 'static/src/css/*.css'],
        dest: 'static/dist/style.css',
        options: {
          //separator: ';\n'
        }
      }
    },
//    uglify: {
//      js: {
//        files: {
//          'static/dist/college.min.js': ['static/dist/college.js']
//        }
//      }
//    },
//    cssmin: {
//      css: {
//        files: [{
//          expand: true,
//          cwd: 'static/dist',
//          src: ['*.css', '!*.min.css'],
//          dest: 'static/dist',
//          ext: '.min.css'
//        }]
//      }
//    },
//    // gzip assets 1-to-1 for production
//    compress: {
//      js: {
//        options: {
//          mode: 'gzip'
//        },
//        expand: true,
//        cwd: 'static/dist/',
//        src: ['*.min.js'],
//        dest: 'static/dist',
//        ext: '.min.js.gz'
//
//      },
//      css: {
//        options: {
//          mode: 'gzip'
//        },
//        expand: true,
//        cwd: 'static/dist/',
//        src: ['*.min.css'],
//        dest: 'static/dist',
//        ext: '.min.css.gz'
//
//      }
//    },
    // Deletes all intermediate files created for the build, but skips our custom files
    clean: ['static/tmp']
  });

  // Load required modules
  grunt.loadNpmTasks('grunt-contrib-copy');
//  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-concat');
//  grunt.loadNpmTasks('grunt-contrib-uglify');
//  grunt.loadNpmTasks('grunt-contrib-cssmin');
//  grunt.loadNpmTasks('grunt-contrib-compress');
//  grunt.loadNpmTasks('grunt-contrib-clean');

  // Task definitions
  grunt.registerTask('default', ['copy','concat']);
//  grunt.registerTask('default', ['copy', 'less', 'concat', 'cssmin','uglify', 'compress','clean']);
  
};