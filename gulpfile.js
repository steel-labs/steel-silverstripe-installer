var gulp = require('gulp'),
    fs = require('fs'),
    copy = require('gulp-copy'),
    replace = require('gulp-replace'),
    vagrantVariables = JSON.parse(fs.readFileSync('./vagrant-variables.json'));


gulp.task('vagrant-setup', function(){
    gulp.src('./Vagrantfile')
        .pipe(replace('@__PathToVagrant__', vagrantVariables.PathToVagrant))
        .pipe(replace('@__ProjectRoot__', vagrantVariables.ProjectRoot))
        .pipe(replace('@__HostName__', vagrantVariables.HostName))
        .pipe(replace('@__DBName__', vagrantVariables.DBName))
        .pipe(replace('@__DBUser__', vagrantVariables.DBUser))
        .pipe(replace('@__DBPsw__', vagrantVariables.DBPsw))
        .pipe(gulp.dest('./'));

    gulp.src('*.js', {read: false})
        .pipe(shell('vagrant up'));
});