module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
    concat: {
      options: {
        stripBanners: true
//        banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
//          '<%= grunt.template.today("yyyy-mm-dd") %> */',
      },
      dist: {
        src: 'sass/global.scss',
        dest: 'sass/main.scss',
      },
    },
		sass: {
			dist: {
				files: {
					'css/main.css' : 'sass/main.scss',
          'admin/css/admin.css' : 'admin/sass/admin.scss'
				}
			}
		},
    jshint: {
        all: ['Gruntfile.js', 'js/*.js', 'admin/js/*.js', '!js/vender/*.js', '!admin/js/vender/*.js', '!js/min/*.js']
    },
		watch: {
			css: {
				files: ['**/*.scss', '**/*.js', '!js/min/*.js'],
				tasks: ['concat', 'sass', 'jshint', 'uglify']
			}
		},
    schema_update: {
      options: {
        driver: 'mysql',
        connection: {
            host: 'localhost',
            user: 'root',
            password: 'mariocart64',
            database: 'tmydblocal',
            multipleStatements: true
        },
        create: {
            connection: {
                host: 'localhost',
                user: 'root',
                password: 'mariocart64'
            },
            createDB: 'tmydblocal',
            createUser: 'kevin',
            createPass: 'mariocart64',
            createHost: 'localhost'
        },
        queryGetVersion: 'SELECT version FROM schema_version',
        querySetVersion: 'REPLACE INTO schema_version (version) VALUES ({version})',
        queryVersionSafe: true
      },
      src: 'patch_scripts/**.sql'
    },
    uglify: {
      my_target: {
        files: {
          'js/min/initControls.min.js': ['js/initControls.js'],
          'js/min/about.min.js': ['js/about.js'],
          'js/min/all-movies.min.js': ['js/all-movies.js'],
          'js/min/home.min.js': ['js/home.js'],
          'js/min/page.min.js': ['js/page.js'],
          'js/min/sortfilter.min.js': ['js/sortfilter.js']
        }
      }
    }
	});
  grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-schema-update');
  grunt.loadNpmTasks('grunt-contrib-uglify');
};
