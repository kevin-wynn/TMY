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
        src: ['sass/variables.scss', 'sass/globals.scss', 'sass/home.scss'],
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
		watch: {
			css: {
				files: '**/*.scss',
				tasks: ['concat', 'sass']
			}
		}
	});
  grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.registerTask('default',['watch']);
}