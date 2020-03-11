@extends('fontend.master')
@section('title')
ছবি 
@endsection
@section('css')
 <style >
       h1 {
    position: absolute;
    top: 83%;
    left: 36%;
    transform: translate(-50%, -50%);
    color: #fff;
    font-family: "Source Sans Pro";
    font-size: 12px;
    font-weight: 900;
    -webkit-user-select: none;
    user-select: none;
}
.birthday-img {
    width: 100%;
    height: 200px;
}
        canvas{display:block; height: 100%; width: 100%}
    </style>
@endsection
@section('js')
<script >
	function myFunction(event) {
	        // helper functions
	    const PI2 = Math.PI * 2
	    const random = (min, max) => Math.random() * (max - min + 1) + min | 0
	    const timestamp = _ => new Date().getTime()

	    // container
	    class Birthday {
	      constructor() {
	        this.resize()

	        // create a lovely place to store the firework
	        this.fireworks = []
	        this.counter = 0

	      }
	      
	      resize() {
	        this.width = 300
	        let center = this.width / 2 | 0
	        this.spawnA = center - center / 4 | 0
	        this.spawnB = center + center / 4 | 0
	        
	        this.height = 300
	        this.spawnC = this.height * .1
	        this.spawnD = this.height * .5
	        
	      }
	      
	      onClick(evt) {
	         let x = evt.clientX || evt.touches && evt.touches[0].pageX
	         let y = evt.clientY || evt.touches && evt.touches[0].pageY
	         
	         let count = random(3,5)
	         for(let i = 0; i < count; i++) this.fireworks.push(new Firework(
	            random(this.spawnA, this.spawnB),
	            this.height,
	            x,
	            y,
	            random(0, 20),
	            random(30, 110)))
	              
	         this.counter = -1
	         
	      }
	      
	      update(delta) {
	        ctx.globalCompositeOperation = 'hard-light'
	        ctx.fillStyle = `rgba(20,20,20,${ 7 * delta })`
	        ctx.fillRect(0, 0, this.width, this.height)

	        ctx.globalCompositeOperation = 'lighter'
	        for (let firework of this.fireworks) firework.update(delta)

	        // if enough time passed... create new new firework
	        this.counter += delta * 3 // each second
	        if (this.counter >= 1) {
	          this.fireworks.push(new Firework(
	            random(this.spawnA, this.spawnB),
	            this.height,
	            random(0, this.width),
	            random(this.spawnC, this.spawnD),
	            random(0, 360),
	            random(30, 110)))
	          this.counter = 0
	        }

	        // remove the dead fireworks
	        if (this.fireworks.length > 1000) this.fireworks = this.fireworks.filter(firework => !firework.dead)

	      }
	    }

	    class Firework {
	      constructor(x, y, targetX, targetY, shade, offsprings) {
	        this.dead = false
	        this.offsprings = offsprings

	        this.x = x
	        this.y = y
	        this.targetX = targetX
	        this.targetY = targetY

	        this.shade = shade
	        this.history = []
	      }
	      update(delta) {
	        if (this.dead) return

	        let xDiff = this.targetX - this.x
	        let yDiff = this.targetY - this.y
	        if (Math.abs(xDiff) > 3 || Math.abs(yDiff) > 3) { // is still moving
	          this.x += xDiff * 2 * delta
	          this.y += yDiff * 2 * delta

	          this.history.push({
	            x: this.x,
	            y: this.y
	          })

	          if (this.history.length > 20) this.history.shift()

	        } else {
	          if (this.offsprings && !this.madeChilds) {
	            
	            let babies = this.offsprings / 2
	            for (let i = 0; i < babies; i++) {
	              let targetX = this.x + this.offsprings * Math.cos(PI2 * i / babies) | 0
	              let targetY = this.y + this.offsprings * Math.sin(PI2 * i / babies) | 0

	              birthday.fireworks.push(new Firework(this.x, this.y, targetX, targetY, this.shade, 0))

	            }

	          }
	          this.madeChilds = true
	          this.history.shift()
	        }
	        
	        if (this.history.length === 0) this.dead = true
	        else if (this.offsprings) { 
	            for (let i = 0; this.history.length > i; i++) {
	              let point = this.history[i]
	              ctx.beginPath()
	              ctx.fillStyle = 'hsl(' + this.shade + ',100%,' + i + '%)'
	              ctx.arc(point.x, point.y, 1, 0, PI2, false)
	              ctx.fill()
	            } 
	          } else {
	          ctx.beginPath()
	          ctx.fillStyle = 'hsl(' + this.shade + ',100%,50%)'
	          ctx.arc(this.x, this.y, 1, 0, PI2, false)
	          ctx.fill()
	        }

	      }
	    }

	    let d_id=event.target.id;
	    let canvas = document.getElementById('birthday'+d_id)

	    let ctx = canvas.getContext('2d')

	    let then = timestamp()

	    let birthday = new Birthday
	    window.onresize = () => birthday.resize()
	    document.onclick = evt => birthday.onClick(evt)
	    document.ontouchstart = evt => birthday.onClick(evt)

	      ;(function loop(){
	        requestAnimationFrame(loop)

	        let now = timestamp()
	        let delta = now - then

	        then = now
	        birthday.update(delta / 1000)
	        

	      })()
	}
</script>
@endsection
@section('mainContent')
<div class="col-md-9 left_con"><!-- left Content Start-->
<div class="panel panel-info">
    <div class="panel-heading" style="font-weight: bold; font-size: 18px; background-color:#5BC0DE; color:#FFFFFF">শুভ জন্মদিন... </div>
    <div class="panel-body">
        
        <div class="row">
            <div class="col-md-3">
                <img class="birthday-img"  id="1" onload="myFunction(event)" src="{{ asset('/public/fontend/images/photo1.jpg')}}">
                    <h1>
                      <p>Name: Jhone </p>
                      <p>Designation: Student </p>
                      <p>Class: six </p>
                      <p>ID: 12345 </p>
                    </h1>
                    <canvas id="birthday1"  width: 200px;height: 200px"></canvas>
            </div>
            <div class="col-md-3">
                <img class="birthday-img"  id="2" onload="myFunction(event)" src="{{ asset('/public/fontend/images/photo1.jpg')}}">
                    <h1>
                      <p>Name: Jhone </p>
                      <p>Designation: Student </p>
                      <p>Class: six </p>
                      <p>ID: 12345 </p>
                    </h1>
                    <canvas id="birthday2"  width: 200px;height: 200px"></canvas>
            </div>
        </div>
        
    </div>
</div>
</div>
@endsection