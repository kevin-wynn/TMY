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
        src: ['sass/variables.scss', 'sass/footer.scss', 'sass/home.scss', 'sass/movie.scss', 'sass/all-movies.scss', 'sass/navbar.scss', 'sass/sortfilter.scss', 'sass/globals.scss'],
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
        all: ['Gruntfile.js', 'js/all-movies.js', 'js/home.js', 'js/page.js', 'admin/admin.js', 'admin/adminHome.js', 'admin/loginBackground.js', 'admin/movies.js', 'admin/permissions.js', 'admin/signup.js', 'admin/users.js', 'js/sortfilter.js']
    },
		watch: {
			css: {
				files: ['**/*.scss', '**/*.js'],
				tasks: ['concat', 'sass', 'jshint']
			}
		}
	});
  grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-jshint');
};