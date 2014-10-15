module.exports = (grunt) ->
 
  grunt.initConfig
    
    shell:
      publish:
        options: 
          stdout: true
        command: 'cd ~/Code && php artisan asset:publish --bench=teman/cms'

    sass:
      compile:
        options:
          style: 'expanded'
        files: [
          expand: true
          cwd: 'assets/sass'
          src: ['**/*.scss']
          dest: 'public/css'
          ext: '.css'
        ]
 
    coffee:
      compile:
        expand: true
        cwd: 'assets/coffee'
        src: ['**/*.coffee']
        dest: 'public/js'
        ext: '.js'
        options:
          bare: true
          preserve_dirs: true
 
    watch:
      sass:
        files: '<%= sass.compile.files[0].src %>'
        tasks: ['sass','shell:publish']
      coffee:
        files: '<%= coffee.compile.src %>'
        tasks: ['coffee','shell:publish']
 
  grunt.loadNpmTasks 'grunt-shell'
  grunt.loadNpmTasks 'grunt-contrib-sass'
  grunt.loadNpmTasks 'grunt-contrib-coffee'
  grunt.loadNpmTasks 'grunt-contrib-watch'

  grunt.registerTask 'default', ['sass', 'coffee', 'watch']