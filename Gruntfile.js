/*!
 * Gruntfile for WP Bootstrap theme
 * Homepage: http://wdmg.com.ua/
 * Author: Vyshnyvetskyy Alexsander (alex.vyshyvetskyy@gmail.com)
 * Copyright 2018 W.D.M.Group, Ukraine
 * Licensed under MIT
*/

module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
		dirs: {
			lang: 'languages',
		},
        concat: {

        },
		copy: {

        },
        uglify: {
            admin: {
                options: {
                    sourceMap: true,
                    sourceMapName: 'assets/js/admin.js.map'
                },
                files: {
                    'assets/js/admin.min.js': ['assets/js/admin.js']
                }
            },
            core: {
                options: {
                    sourceMap: true,
                    sourceMapName: 'assets/js/core.js.map'
                },
                files: {
                    'assets/js/core.min.js': ['assets/js/core.js']
                }
            }
        },
		makepot: {
			target: {
				options: {
					mainFile: 'style.css',
					domainPath: '/languages',
					type: 'wp-theme',
					potFilename: 'wp-bootstrap.pot',
					updateTimestamp: true,
					potHeaders: {
						poedit: true,
						'last-translator': 'Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>',
						'language-team': 'Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>',
						'plural-forms': 'nplurals=2; plural=(n != 1);',
						'language': 'en',
						'x-poedit-country': 'Ukraine',
						'x-poedit-language': 'Russian',
						'x-poedit-sourcecharset': 'UTF-8',
						'x-poedit-basepath': '../',
						'x-poedit-searchpath-0': '.',
						'x-poedit-bookmarks': '',
						'x-textdomain-support': 'yes',
						'x-poedit-keywordslist': true
					},
					updateTimestamp: true,
					updatePoFiles: true
				}
			}
		},
		potomo: {
			dist: {
				options: {
					poDel: false
				},
				files: [{
					expand: true,
					cwd: '<%= dirs.lang %>',
					src: ['*.po'],
					dest: '<%= dirs.lang %>',
					ext: '.mo',
					nonull: true
				}]
			}
		},
		sass: {
			style: {
				files: {
					'assets/css/admin.css': ['assets/css/admin.scss'],
					'assets/css/ie.css': ['assets/css/ie.scss'],
					'assets/css/style.css': ['assets/css/style.scss']
				}
			}
		},
        autoprefixer: {
            dist: {
                files: {
                    'assets/css/admin.css': ['assets/css/admin.css'],
                    'assets/css/ie.css': ['assets/css/ie.css'],
                    'assets/css/style.css': ['assets/css/style.css']
                }
            }
        },
        cssmin: {
            options: {
                mergeIntoShorthands: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    'assets/css/admin.min.css': ['assets/css/admin.css'],
                    'assets/css/ie.min.css': ['assets/css/ie.css'],
                    'assets/css/style.min.css': ['assets/css/style.css']
                }
            }
        },
		watch: {
			styles: {
				files: ['assets/css/admin.scss', 'assets/css/ie.scss', 'assets/css/style.scss'],
				tasks: ['sass:style', 'cssmin'],
				options: {
					spawn: false
				}
			},
			languages: {
				files: ['languages/*.po'],
				tasks: ['potomo']
			},
			scripts: {
				files: ['assets/js/admin.js', 'assets/js/core.js'],
				tasks: ['uglify:core'],
				options: {
					spawn: false
				},
			}
		}
    });

	// npm install grunt-contrib-concat grunt-contrib-uglify-es grunt-contrib-copy grunt-contrib-sass grunt-contrib-watch grunt-css grunt-contrib-cssmin grunt-autoprefixer
    grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify-es');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-css');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-potomo');
	grunt.loadNpmTasks('grunt-wp-i18n');
	grunt.registerTask('translate', ['makepot', 'potomo']);
    grunt.registerTask('default', ['uglify', 'makepot', 'sass', 'autoprefixer', 'cssmin']);
};
