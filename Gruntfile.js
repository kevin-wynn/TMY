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
        src: ['sass/variables.scss', 'sass/footer.scss', 'sass/home.scss', 'sass/about.scss', 'sass/movie.scss', 'sass/all-movies.scss', 'sass/navbar.scss', 'sass/sortfilter.scss', 'sass/discover.scss', 'sass/globals.scss'],
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
        all: ['Gruntfile.js', 'js/all-movies.js', 'js/home.js', 'js/about.js', 'js/page.js', 'admin/admin.js', 'admin/adminHome.js', 'admin/loginBackground.js', 'admin/movies.js', 'admin/permissions.js', 'admin/signup.js', 'admin/users.js', 'js/sortfilter.js']
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