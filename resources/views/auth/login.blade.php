<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymPro — Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;600;700&family=Barlow+Condensed:wght@700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <style>
        :root { --red:#ff3c2e; --dark:#000005; --white:#f0f0ff; --muted:#556; }
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        html,body{height:100%;}
        body{background:var(--dark);color:var(--white);font-family:'Barlow',sans-serif;overflow:hidden;cursor:none;}
        #space-canvas{position:fixed;inset:0;z-index:0;pointer-events:none;}
        #cur{width:10px;height:10px;background:var(--red);border-radius:50%;position:fixed;pointer-events:none;z-index:9999;transform:translate(-50%,-50%);box-shadow:0 0 12px var(--red);}
        #cur-ring{width:38px;height:38px;border:1px solid rgba(255,60,46,.5);border-radius:50%;position:fixed;pointer-events:none;z-index:9998;transform:translate(-50%,-50%);transition:width .3s,height .3s;}

        .page{min-height:100vh;display:grid;grid-template-columns:1fr 1fr;position:relative;z-index:1;}

        /* LEFT */
        .left{display:flex;flex-direction:column;justify-content:center;align-items:flex-start;padding:4rem 5rem;position:relative;overflow:hidden;}
        .left-bg{position:absolute;inset:0;background-image:url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=900&q=80');background-size:cover;background-position:center;filter:brightness(.2) saturate(.5);}
        .left-overlay{position:absolute;inset:0;background:linear-gradient(135deg,rgba(0,0,5,.92) 0%,rgba(255,60,46,.06) 100%);}
        .left-content{position:relative;z-index:2;}
        .logo{font-family:'Bebas Neue',sans-serif;font-size:2.2rem;letter-spacing:5px;text-decoration:none;color:var(--white);margin-bottom:3rem;display:block;}
        .logo span{color:var(--red);text-shadow:0 0 20px rgba(255,60,46,.6);}
        .left h1{font-family:'Barlow Condensed',sans-serif;font-size:clamp(3rem,5vw,5.5rem);font-weight:900;text-transform:uppercase;line-height:.9;margin-bottom:1.5rem;}
        .ghost{-webkit-text-stroke:1px rgba(240,240,255,.2);color:transparent;}
        .accent{color:var(--red);text-shadow:0 0 30px rgba(255,60,46,.5);}
        .left p{color:rgba(240,240,255,.4);font-size:1rem;line-height:1.8;font-weight:300;max-width:360px;margin-bottom:2.5rem;}

        /* STATS */
        .stats{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:2rem;}
        .stat{text-align:center;}
        .stat-num{font-family:'Bebas Neue',sans-serif;font-size:2.5rem;color:var(--red);line-height:1;text-shadow:0 0 20px rgba(255,60,46,.4);}
        .stat-lbl{font-size:.65rem;letter-spacing:2px;text-transform:uppercase;color:var(--muted);margin-top:.2rem;}

        /* RIGHT */
        .right{display:flex;flex-direction:column;justify-content:center;padding:3rem 5rem;background:rgba(0,0,8,.75);backdrop-filter:blur(30px);border-left:1px solid rgba(255,255,255,.05);}
        .form-title{font-family:'Barlow Condensed',sans-serif;font-size:2.8rem;font-weight:900;text-transform:uppercase;margin-bottom:.3rem;}
        .form-sub{font-size:.82rem;color:rgba(240,240,255,.4);margin-bottom:2.5rem;}
        .form-sub a{color:var(--red);text-decoration:none;}

        .form-group{margin-bottom:1.2rem;}
        label{font-size:.68rem;letter-spacing:2.5px;text-transform:uppercase;color:var(--muted);display:block;margin-bottom:.5rem;}
        input{width:100%;background:rgba(0,0,8,.9);border:1px solid rgba(255,255,255,.08);color:var(--white);padding:.9rem 1.1rem;font-family:'Barlow',sans-serif;font-size:.95rem;outline:none;transition:border-color .3s,box-shadow .3s;}
        input::placeholder{color:rgba(240,240,255,.2);}
        input:focus{border-color:var(--red);box-shadow:0 0 20px rgba(255,60,46,.15);}

        .remember-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;}
        .remember{display:flex;align-items:center;gap:.5rem;font-size:.78rem;color:rgba(240,240,255,.4);cursor:none;}
        .remember input[type=checkbox]{width:auto;padding:0;accent-color:var(--red);}
        .forgot{font-size:.78rem;color:var(--red);text-decoration:none;transition:text-shadow .3s;}
        .forgot:hover{text-shadow:0 0 10px rgba(255,60,46,.6);}

        .btn-submit{width:100%;background:var(--red);color:var(--white);border:none;padding:1.1rem;font-family:'Barlow',sans-serif;font-size:.9rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;cursor:none;transition:all .3s;box-shadow:0 0 25px rgba(255,60,46,.3);clip-path:polygon(0 0,calc(100% - 8px) 0,100% 8px,100% 100%,8px 100%,0 calc(100% - 8px));}
        .btn-submit:hover{box-shadow:0 0 50px rgba(255,60,46,.6);transform:translateY(-2px);}

        .err-box{background:rgba(255,60,46,.08);border:1px solid rgba(255,60,46,.3);padding:.8rem 1rem;margin-bottom:1.2rem;font-size:.82rem;color:#ff6b5b;}
        .err{font-size:.72rem;color:#ff6b5b;margin-top:.3rem;}

        .divider{display:flex;align-items:center;gap:1rem;margin:1.5rem 0;}
        .divider::before,.divider::after{content:'';flex:1;height:1px;background:rgba(255,255,255,.07);}
        .divider span{font-size:.7rem;letter-spacing:2px;text-transform:uppercase;color:var(--muted);}

        .register-prompt{text-align:center;font-size:.82rem;color:rgba(240,240,255,.35);}
        .register-prompt a{color:var(--red);text-decoration:none;font-weight:600;}

        /* Glow ring around form */
        .right::before{content:'';position:absolute;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(255,60,46,.04) 0%,transparent 70%);top:50%;left:50%;transform:translate(-50%,-50%);pointer-events:none;}

        @media(max-width:768px){
            .page{grid-template-columns:1fr;}
            .left{display:none;}
            .right{padding:2rem 1.5rem;}
        }
    </style>
</head>
<body>
<canvas id="space-canvas"></canvas>
<div id="cur"></div>
<div id="cur-ring"></div>

<div class="page">
    <!-- LEFT -->
    <div class="left">
        <div class="left-bg"></div>
        <div class="left-overlay"></div>
        <div class="left-content">
            <a href="/" class="logo">Gym<span>Pro</span></a>
            <h1>
                WELCOME<br>
                <span class="ghost">BACK</span><br>
                <span class="accent">CHAMPION</span>
            </h1>
            <p>Your transformation journey continues. Log in to access your personalized workouts, diet charts, and progress dashboard.</p>
            <div class="stats">
                <div class="stat"><div class="stat-num">500+</div><div class="stat-lbl">Exercises</div></div>
                <div class="stat"><div class="stat-num">10K+</div><div class="stat-lbl">Members</div></div>
                <div class="stat"><div class="stat-num">98%</div><div class="stat-lbl">Success</div></div>
            </div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="right" style="position:relative;">
        <div class="form-title">Sign In</div>
        <div class="form-sub">New here? <a href="/register">Create a free account →</a></div>

        @if(session('status'))
        <div style="background:rgba(70,180,70,.1);border:1px solid rgba(70,180,70,.3);padding:.8rem 1rem;margin-bottom:1.2rem;font-size:.82rem;color:#70b86e;">
            ✓ {{ session('status') }}
        </div>
        @endif

        @if($errors->any())
        <div class="err-box">
            @foreach($errors->all() as $error)
                <div>⚠ {{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
                @error('email')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password" required>
                @error('password')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="remember-row">
                <label class="remember">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                </label>
                @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="btn-submit">Sign In →</button>
        </form>

        <div class="divider"><span>or</span></div>
        <div class="register-prompt">Don't have an account? <a href="/register">Join GymPro Free</a></div>
    </div>
</div>

<script>
(function(){
    const canvas=document.getElementById('space-canvas');
    const renderer=new THREE.WebGLRenderer({canvas,antialias:true,alpha:true});
    renderer.setSize(window.innerWidth,window.innerHeight);
    renderer.setClearColor(0x000005,1);
    const scene=new THREE.Scene();
    const camera=new THREE.PerspectiveCamera(75,window.innerWidth/window.innerHeight,0.1,2000);
    camera.position.z=400;
    const geo=new THREE.BufferGeometry();
    const n=5000,pos=new Float32Array(n*3),col=new Float32Array(n*3);
    for(let i=0;i<n;i++){
        pos[i*3]=(Math.random()-.5)*2000;pos[i*3+1]=(Math.random()-.5)*2000;pos[i*3+2]=(Math.random()-.5)*2000;
        const r=Math.random();
        if(r<.05){col[i*3]=1;col[i*3+1]=.2;col[i*3+2]=.1;}
        else{const v=.6+Math.random()*.4;col[i*3]=v;col[i*3+1]=v;col[i*3+2]=v;}
    }
    geo.setAttribute('position',new THREE.BufferAttribute(pos,3));
    geo.setAttribute('color',new THREE.BufferAttribute(col,3));
    scene.add(new THREE.Points(geo,new THREE.PointsMaterial({size:1.2,vertexColors:true,transparent:true,opacity:.8})));
    let t=0,mx=0,my=0;
    document.addEventListener('mousemove',e=>{mx=(e.clientX/window.innerWidth-.5)*2;my=(e.clientY/window.innerHeight-.5)*2;});
    (function animate(){requestAnimationFrame(animate);t+=.003;scene.rotation.y=t*.05+mx*.04;scene.rotation.x=my*.03;renderer.render(scene,camera);})();
    window.addEventListener('resize',()=>{camera.aspect=window.innerWidth/window.innerHeight;camera.updateProjectionMatrix();renderer.setSize(window.innerWidth,window.innerHeight);});
})();
const cur=document.getElementById('cur'),ring=document.getElementById('cur-ring');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;cur.style.left=mx+'px';cur.style.top=my+'px';});
(function loop(){rx+=(mx-rx)*.1;ry+=(my-ry)*.1;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(loop);})();
document.querySelectorAll('a,button,input,label').forEach(el=>{
    el.addEventListener('mouseenter',()=>{ring.style.width='55px';ring.style.height='55px';ring.style.borderColor='rgba(255,60,46,.9)';});
    el.addEventListener('mouseleave',()=>{ring.style.width='38px';ring.style.height='38px';ring.style.borderColor='rgba(255,60,46,.5)';});
});
</script>
</body>
</html>
