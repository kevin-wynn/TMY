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
        src: ['sass/variables.scss', 'sass/*.scss'],
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
        all: ['Gruntfile.js', 'js/*.js', 'admin/js/*.js', '!js/vender/*.js', '!admin/js/vender/*.js']
    },
		watch: {
			css: {
				files: ['**/*.scss', '**/*.js'],
				tasks: ['concat', 'sass', 'jshint']
			}
		},
    schema_update: {
      options: {
        driver: 'mysql',
        connection: {
            host: 'localhost',
            user: 'root',
            password: 'mariocart64',
            database: 'tmydbLocal',
            multipleStatements: true
        },
        create: {
            connection: {
                host: 'localhost',
                user: 'root',
                password: 'mariocart64'
            },
            createDB: 'tmydbLocal',
            createUser: 'kevin',
            createPass: 'mariocart64',
            createHost: 'localhost'
        },
        queryGetVersion: 'SELECT version FROM schema_version',
        querySetVersion: 'REPLACE INTO schema_version (version) VALUES ({version})',
        queryVersionSafe: true
      },
      src: 'patch_scripts/**.sql'
    }
	});
  grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-schema-update');
};