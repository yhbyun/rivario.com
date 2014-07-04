# gulp.js

YongHun Byun
[@river](http://twitter.com/river)

---

<!-- .slide: data-background="#fff" class="light" -->

![](http://image.aladin.co.kr/product/222/58/letslook/8990758963_f.jpg)

---

## 자바스크립트, 스타일시트, 이미지

#### HTTP 요청을 줄여라 <!-- .element: class="fragment" data-fragment-index="1" -->
#### 자바스크립트와 스타일시트는 외부파일로 분리하라 <!-- .element: class="fragment" data-fragment-index="2" -->
#### 자바스크립트를 최소화 하라 <!-- .element: class="fragment" data-fragment-index="3" -->
#### 중복되는 스크립트는 제거하라 <!-- .element: class="fragment" data-fragment-index="4" -->

---

<!-- .slide: data-background="http://www.mendos.org/wp-content/uploads/2014/02/AssetRecovery.jpg" -->

# Asset

---

## 웹에서 말하는 Asset은?

### Javascript <!-- .element: class="fragment" data-fragment-index="1" -->
### CSS <!-- .element: class="fragment" data-fragment-index="2" -->
### Image <!-- .element: class="fragment" data-fragment-index="3" -->

---

## Asset을 가지고 뭘하지?

#### 전처리(Coffee, SASS, LESS, ...) <!-- .element: class="fragment" data-fragment-index="1" -->
#### lint(jshint, csslint, ...) <!-- .element: class="fragment" data-fragment-index="2" -->
#### 합치기(concat) <!-- .element: class="fragment" data-fragment-index="3" -->
#### 사이즈 줄이기(minify, ugligy, optimize) <!-- .element: class="fragment" data-fragment-index="4" -->

---

<!-- .slide: data-background="#00f3a5" class="light"-->

## Asset 도구

---

<!-- .slide: data-background="http://uploads.neatorama.com/images/posts/900/53/53900/1350816663-0.jpg" -->

# Asset Pipeline

## Ruby on Rails Asset Pipeline

## Laravel codesleeve/asset-pipeline

---

<!-- .slide: data-background="#fff" class="light"-->

# Grunt

![](http://static.grayghostvisuals.com/imgblog/grunt.png)

---

<!-- .slide: data-background="#fff" class="light"-->

# Gulp

<img src="http://markdalgleish.github.io/presentation-build-wars-gulp-vs-grunt/images/gulp.png">

---


<!-- .slide: data-background="http://markdalgleish.github.io/presentation-build-wars-gulp-vs-grunt/images/gif/fight.gif" -->

# Grunt vs Gulp

---

<!-- .slide: data-background="#00f3a5" class="light" -->

## A brief history of Grunt

---

<img src="http://markdalgleish.github.io/presentation-build-wars-gulp-vs-grunt/images/cowboy.jpg" class="avatar">

> I realized that a task-based build tool with <b>built-in, commonly used tasks</b> was the approach that would work best for me

<a href="https://twitter.com/cowboy">Ben Alman</a>
<br>
<small>March 2012</small>

---

### Single, global Grunt:

```
$ npm install -g grunt
```

---

### Configuration over code

```
grunt.initConfig({
  lint: {
    src: 'src/<%= pkg.name %>.js'
  },
  concat: {
    src: [
      '<banner:meta.banner>',
      '<file_strip_banner:src/<%= pkg.name %>.js>'
    ],
    dest: '<%= pkg.name %>.js'
  }
});
```

---

### Built-in init task to get you started

```
$ grunt-init jquery
```

---

<!-- .slide: data-background="#00f3a5" class="light"-->

## Simple config

Common build steps

Designed for small libraries & plugins

---

<!--
# OMG GRUNT

.slide: data-background="http://markdalgleish.github.io/presentation-build-wars-gulp-vs-grunt/images/gif/yeaa.gif"

---
-->

<!-- .slide: data-background="http://markdalgleish.github.io/presentation-build-wars-gulp-vs-grunt/images/gif/neverending.gif" -->

# GRUNT 0.4
## + <!-- .element: class="fragment" data-fragment-index="2" -->
# BOWER <!-- .element: class="fragment" data-fragment-index="3" -->
## + <!-- .element: class="fragment" data-fragment-index="4" -->
# YEOMAN  <!-- .element: class="fragment" data-fragment-index="5" -->

---

<!-- .slide: data-background="http://markdalgleish.github.io/presentation-build-wars-gulp-vs-grunt/images/gif/slowclap.gif" -->

---

<!-- .slide: data-background="http://markdalgleish.github.io/presentation-build-wars-gulp-vs-grunt/images/gif/ryu.gif" -->

# A CHALLENGER APPEARS

---

<!-- .slide: data-background="#fff"-->

<img src="http://markdalgleish.github.io/presentation-build-wars-gulp-vs-grunt/images/gulp.png">

---

### Stream-based build system
### Code over configuration <!-- .element: class="fragment" data-fragment-index="2" -->
### Small, idiomatic Node modules <!-- .element: class="fragment" data-fragment-index="3" -->
### Really simple, elegant API <!-- .element: class="fragment" data-fragment-index="4" -->

---

## Basic Gulpfile

```
var gulp = require('gulp'),
  stylus = require('gulp-stylus'),
  autoprefixer = require('gulp-autoprefixer');
```

```
gulp.task('default', function() {
  return gulp.src('src/styles/*.styl')
    .pipe(stylus())
    .pipe(autoprefixer())
    .pipe(gulp.dest('public/styles'));
});
```

---

## Gulp tasks run from terminal

```
$ gulp taskname
```

---

## Streaming Builds

```
gulp.src('src/foobar.styl') // <-- Read from FS

  // In memory transforms:
  .pipe(stylus())
  .pipe(rename({ ext: 'css' }))
  .pipe(autoprefixer())
  .pipe(cssmin())
  .pipe(header('/* Copyright 2014 */'))

  .pipe(gulp.dest('dist')) // <-- Write to FS
```

---

# Steams ?

<!-- .slide: data-background="https://s3.amazonaws.com/media-p.slid.es/uploads/contra/images/65429/V06pPLp.gif" -->

---

빌드 시스템을 머리 속에 그려보세요.
<br><br>
(파일을 갖고 와서, 수정하고, 그 결과를 출력합니다.)

---

## 이런 그림을 그립니다

![](http://i.imgur.com/B0B77QN.png)

---

## 이런 그림을 그리진 않죠

![](http://i.imgur.com/oeCGJUS.png)

---

<img src="http://markdalgleish.github.io/presentation-build-wars-gulp-vs-grunt/images/maxogden.png" class="avatar">

> best part about <a href="http://twitter.com/gulpjs">@gulpjs</a> is that people are writing generic, streaming node modules that have nothing to do w/ gulp except the module name :)

<a href="https://twitter.com/maxogden">@maxogden</a>

---

## 소스를 다시 봅시다.

```
gulp.src('src/foobar.styl') // <-- Read from FS

  // In memory transforms:
  .pipe(stylus())
  .pipe(rename({ ext: 'css' }))
  .pipe(autoprefixer())
  .pipe(cssmin())
  .pipe(header('/* Copyright 2014 */'))

  .pipe(gulp.dest('dist')) // <-- Write to FS
```

---

## Grunt와 비교해 봅시다.

```
grunt.initConfig({
  lint: {
    src: 'src/<%= pkg.name %>.js'
  },
  concat: {
    src: [
      '<banner:meta.banner>',
      '<file_strip_banner:src/<%= pkg.name %>.js>'
    ],
    dest: '<%= pkg.name %>.js'
  }
});
```

---

<!-- .slide: data-background="http://markdalgleish.github.io/presentation-build-wars-gulp-vs-grunt/images/gif/clap.gif" -->

# LET'S LEARN THE GULP API

## It's not too hard. <!-- .element: class="fragment" data-fragment-index="2" -->

---

## gulp.task

```
gulp.task('name', ['deps'], function(done) {

  return stream || promise;
  // ...or, call done()

});
```

---

## gulp.watch

```
gulp.watch('src/**/*.js', ['test', 'compile']);
```

---

## gulp.src

### Returns a readable stream

```
gulp.src(['src/**/*.js', 'test/spec/**/*.js'])
```

---

## gulp.dest

### Returns a "through stream"

```
gulp.src('src')
  .pipe(...)
  .pipe(gulp.dest('dist'));
```

### Yes, that means you can keep piping! <!-- .element: class="fragment" data-fragment-index="2" -->

---

<!-- .slide: data-background="http://markdalgleish.github.io/presentation-build-wars-gulp-vs-grunt/images/gif/shigeru.gif" -->

## task, watch, src, dest

# That's it. <!-- .element: class="fragment" data-fragment-index="2" -->

---

<!-- .slide: data-background="https://s3.amazonaws.com/media-p.slid.es/uploads/contra/images/65995/vcX93RJ.jpg" -->

## Congratulations

### You are now a Gulp expert

---

<!-- .slide: data-background="#00f3a5" class="light"-->

## But...

### How do you run all the tasks sequentially?

---

<!-- .slide: data-background="http://markdalgleish.github.io/presentation-build-wars-gulp-vs-grunt/images/gif/conductor.gif" -->

## Gulp uses <a href="https://github.com/robrich/orchestrator">Orchestrator</a>

### Just specify task dependencies <!-- .element: class="fragment" data-fragment-index="1" -->

### Tasks run with maximum concurrency <!-- .element: class="fragment" data-fragment-index="2" -->

---

# 데모

---

## 기타 ...

- gulp --tasks
- gulp blacklist
- plugin
	- gulp-filter
	- gulp-if
- plugin 문제

---

<!-- .slide: data-background="#00f3a5" class="light"-->

# 결론

### 써볼만 하지만 좀 불안. 내가 잘못했을 수도 <!-- .element: class="fragment" data-fragment-index="1" -->
### 프런트 빌드 시스템 사용은 필수 <!-- .element: class="fragment" data-fragment-index="2" -->
### yeoman, google의 gulp 지원 <!-- .element: class="fragment" data-fragment-index="3" -->

---

<!-- .slide: data-background="https://s3.amazonaws.com/media-p.slid.es/uploads/contra/images/65997/m9WRR1h.jpg" -->

## Questions?

---

## Reference

- https://github.com/gulpjs/gulp/tree/master/docs
- http://slides.com/contra/gulp
- http://www.slideshare.net/jayharris/dethroning-grunt-simple-and-effective-builds-with-gulpjs
- http://www.smashingmagazine.com/2014/06/11/building-with-gulp/
- [Build Wars](http://markdalgleish.github.io/presentation-build-wars-gulp-vs-grunt/)

