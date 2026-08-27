<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymPro — Create Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;600;700&family=Barlow+Condensed:wght@700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <style>
        :root {
            --red: #ff3c2e;
            --dark: #000005;
            --card: rgba(255,255,255,0.03);
            --border: rgba(255,255,255,0.08);
            --white: #f0f0ff;
            --muted: #556;
        }
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html, body { height:100%; }
        body { background:var(--dark); color:var(--white); font-family:'Barlow',sans-serif; overflow-x:hidden; cursor:none; }

        #space-canvas { position:fixed; inset:0; z-index:0; pointer-events:none; }

        /* CURSOR */
        #cur { width:10px; height:10px; background:var(--red); border-radius:50%; position:fixed; pointer-events:none; z-index:9999; transform:translate(-50%,-50%); box-shadow:0 0 12px var(--red); transition:transform .15s; }
        #cur-ring { width:38px; height:38px; border:1px solid rgba(255,60,46,.5); border-radius:50%; position:fixed; pointer-events:none; z-index:9998; transform:translate(-50%,-50%); transition:width .3s,height .3s; }

        /* LAYOUT */
        .page { min-height:100vh; display:grid; grid-template-columns:1fr 1fr; position:relative; z-index:1; }

        /* LEFT SIDE */
        .left {
            display:flex; flex-direction:column; justify-content:center; align-items:flex-start;
            padding:4rem 5rem; position:relative; overflow:hidden;
        }
        .left-bg { position:absolute; inset:0; background-image:url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=900&q=80'); background-size:cover; background-position:center; filter:brightness(.25) saturate(.6); }
        .left-overlay { position:absolute; inset:0; background:linear-gradient(135deg,rgba(0,0,5,.9) 0%,rgba(255,60,46,.08) 100%); }
        .left-content { position:relative; z-index:2; }
        .logo { font-family:'Bebas Neue',sans-serif; font-size:2.2rem; letter-spacing:5px; text-decoration:none; color:var(--white); margin-bottom:3rem; display:block; }
        .logo span { color:var(--red); text-shadow:0 0 20px rgba(255,60,46,.6); }
        .left h1 { font-family:'Barlow Condensed',sans-serif; font-size:clamp(3rem,5vw,5rem); font-weight:900; text-transform:uppercase; line-height:.9; margin-bottom:1.5rem; }
        .left h1 .ghost { -webkit-text-stroke:1px rgba(240,240,255,.2); color:transparent; }
        .left h1 .accent { color:var(--red); text-shadow:0 0 30px rgba(255,60,46,.5); }
        .left p { color:rgba(240,240,255,.45); font-size:1rem; line-height:1.8; font-weight:300; max-width:380px; margin-bottom:2.5rem; }
        .features { display:flex; flex-direction:column; gap:.8rem; }
        .feat { display:flex; align-items:center; gap:.8rem; font-size:.82rem; color:rgba(240,240,255,.55); letter-spacing:.5px; }
        .feat-dot { width:6px; height:6px; border-radius:50%; background:var(--red); box-shadow:0 0 8px var(--red); flex-shrink:0; }

        /* RIGHT SIDE */
        .right { display:flex; flex-direction:column; justify-content:center; padding:3rem 4rem; background:rgba(0,0,8,.7); backdrop-filter:blur(30px); border-left:1px solid rgba(255,255,255,.05); overflow-y:auto; }
        .form-header { margin-bottom:2rem; }
        .form-title { font-family:'Barlow Condensed',sans-serif; font-size:2.2rem; font-weight:900; text-transform:uppercase; margin-bottom:.3rem; }
        .form-sub { font-size:.82rem; color:rgba(240,240,255,.4); letter-spacing:.5px; }
        .form-sub a { color:var(--red); text-decoration:none; }
        .form-sub a:hover { text-shadow:0 0 10px rgba(255,60,46,.5); }

        /* FORM */
        .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:.8rem; }
        .form-group { margin-bottom:.8rem; }
        .form-group.full { grid-column:span 2; }
        label { font-size:.68rem; letter-spacing:2.5px; text-transform:uppercase; color:var(--muted); display:block; margin-bottom:.45rem; }
        input, select {
            width:100%; background:rgba(0,0,8,.8); border:1px solid rgba(255,255,255,.08);
            color:var(--white); padding:.8rem 1rem; font-family:'Barlow',sans-serif; font-size:.9rem;
            outline:none; transition:border-color .3s,box-shadow .3s; appearance:none;
        }
        input::placeholder { color:rgba(240,240,255,.25); }
        input:focus, select:focus { border-color:var(--red); box-shadow:0 0 15px rgba(255,60,46,.15); }
        select option { background:#0a0a15; color:var(--white); }

        .inp-row { display:grid; grid-template-columns:1fr 1fr; gap:.8rem; }

        /* ERROR */
        .err { font-size:.72rem; color:#ff6b5b; margin-top:.3rem; }
        .err-box { background:rgba(255,60,46,.08); border:1px solid rgba(255,60,46,.3); padding:.8rem 1rem; margin-bottom:1rem; font-size:.82rem; color:#ff6b5b; }

        /* SUBMIT */
        .btn-submit {
            width:100%; background:var(--red); color:var(--white); border:none;
            padding:1rem; font-family:'Barlow',sans-serif; font-size:.9rem; font-weight:700;
            letter-spacing:3px; text-transform:uppercase; cursor:none; transition:all .3s;
            margin-top:.5rem; position:relative; overflow:hidden;
            box-shadow:0 0 25px rgba(255,60,46,.3);
            clip-path:polygon(0 0,calc(100% - 8px) 0,100% 8px,100% 100%,8px 100%,0 calc(100% - 8px));
        }
        .btn-submit:hover { box-shadow:0 0 40px rgba(255,60,46,.6); transform:translateY(-1px); }
        .btn-submit::before { content:''; position:absolute; inset:0; background:rgba(255,255,255,.1); transform:translateX(-100%); transition:transform .4s; }
        .btn-submit:hover::before { transform:translateX(0); }

        .divider { display:flex; align-items:center; gap:1rem; margin:.8rem 0; }
        .divider::before, .divider::after { content:''; flex:1; height:1px; background:rgba(255,255,255,.07); }
        .divider span { font-size:.7rem; letter-spacing:2px; text-transform:uppercase; color:var(--muted); }

        /* FITNESS GOAL */
        .goal-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:.5rem; }
        .goal-opt { display:none; }
        .goal-lbl {
            border:1px solid rgba(255,255,255,.08); padding:.7rem .5rem; text-align:center;
            font-size:.72rem; letter-spacing:1.5px; text-transform:uppercase; color:var(--muted);
            cursor:none; transition:all .3s;
        }
        .goal-opt:checked + .goal-lbl { border-color:var(--red); color:var(--red); background:rgba(255,60,46,.08); box-shadow:0 0 15px rgba(255,60,46,.15); }
        .goal-lbl:hover { border-color:rgba(255,60,46,.4); color:rgba(240,240,255,.7); }

        @media(max-width:768px){
            .page { grid-template-columns:1fr; }
            .left { display:none; }
            .right { padding:2rem 1.5rem; }
            .form-grid { grid-template-columns:1fr; }
            .form-group.full { grid-column:span 1; }
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
                JOIN THE<br>
                <span class="ghost">ELITE</span><br>
                <span class="accent">SQUAD</span>
            </h1>
            <p>Start your transformation journey today. Get personalized workouts, diet charts, and progress tracking built for your goals.</p>
            <div class="features">
                <div class="feat"><span class="feat-dot"></span>500+ Muscle-based workout plans</div>
                <div class="feat"><span class="feat-dot"></span>Personalized diet charts</div>
                <div class="feat"><span class="feat-dot"></span>Real-time progress tracking</div>
                <div class="feat"><span class="feat-dot"></span>BMI & body stats calculator</div>
                <div class="feat"><span class="feat-dot"></span>Expert trainer guidance</div>
            </div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
        <div class="form-header">
            <div class="form-title">Create Account</div>
            <div class="form-sub">Already have an account? <a href="/login">Sign in →</a></div>
        </div>

        @if($errors->any())
        <div class="err-box">
            @foreach($errors->all() as $error)
                <div>⚠ {{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-grid">
                <!-- Name -->
                <div class="form-group full">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Kavinesh S" required autofocus>
                    @error('name')<div class="err">{{ $message }}</div>@enderror
                </div>

                <!-- Email -->
                <div class="form-group full">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                    @error('email')<div class="err">{{ $message }}</div>@enderror
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+91 99999 99999">
                    @error('phone')<div class="err">{{ $message }}</div>@enderror
                </div>

                <!-- Gender -->
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="" disabled selected>Select gender</option>
                        <option value="male"   {{ old('gender')=='male'   ? 'selected':'' }}>Male</option>
                        <option value="female" {{ old('gender')=='female' ? 'selected':'' }}>Female</option>
                        <option value="other"  {{ old('gender')=='other'  ? 'selected':'' }}>Other</option>
                    </select>
                    @error('gender')<div class="err">{{ $message }}</div>@enderror
                </div>

                <!-- DOB -->
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                    @error('date_of_birth')<div class="err">{{ $message }}</div>@enderror
                </div>

                <!-- Height & Weight -->
                <div class="form-group">
                    <label for="height">Height (cm) &amp; Weight (kg)</label>
                    <div class="inp-row">
                        <input type="number" id="height" name="height" value="{{ old('height') }}" placeholder="cm e.g. 175">
                        <input type="number" id="weight" name="weight" value="{{ old('weight') }}" placeholder="kg e.g. 70">
                    </div>
                    @error('height')<div class="err">{{ $message }}</div>@enderror
                    @error('weight')<div class="err">{{ $message }}</div>@enderror
                </div>

                <!-- Fitness Goal -->
                <div class="form-group full">
                    <label>Fitness Goal</label>
                    <div class="goal-grid">
                        <div>
                            <input type="radio" class="goal-opt" name="fitness_goal" id="g_bulk" value="bulk" {{ old('fitness_goal')=='bulk' ? 'checked':'' }}>
                            <label class="goal-lbl" for="g_bulk">💪 Bulk Up</label>
                        </div>
                        <div>
                            <input type="radio" class="goal-opt" name="fitness_goal" id="g_cut" value="cut" {{ old('fitness_goal','maintain')=='cut' ? 'checked':'' }}>
                            <label class="goal-lbl" for="g_cut">🔥 Cut Fat</label>
                        </div>
                        <div>
                            <input type="radio" class="goal-opt" name="fitness_goal" id="g_maintain" value="maintain" {{ old('fitness_goal','maintain')=='maintain' ? 'checked':'' }}>
                            <label class="goal-lbl" for="g_maintain">⚡ Maintain</label>
                        </div>
                    </div>
                    @error('fitness_goal')<div class="err">{{ $message }}</div>@enderror
                </div>

                <div class="divider full"><span>Security</span></div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Min 8 characters" required>
                    @error('password')<div class="err">{{ $message }}</div>@enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat password" required>
                </div>

                <!-- Submit -->
                <div class="form-group full">
                    <button type="submit" class="btn-submit">Create My Account →</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// SPACE BG
(function(){
    const canvas=document.getElementById('space-canvas');
    const renderer=new THREE.WebGLRenderer({canvas,antialias:true,alpha:true});
    renderer.setSize(window.innerWidth,window.innerHeight);
    renderer.setClearColor(0x000005,1);
    const scene=new THREE.Scene();
    const camera=new THREE.PerspectiveCamera(75,window.innerWidth/window.innerHeight,0.1,2000);
    camera.position.z=400;
    const geo=new THREE.BufferGeometry();
    const n=5000, pos=new Float32Array(n*3), col=new Float32Array(n*3);
    for(let i=0;i<n;i++){
        pos[i*3]=(Math.random()-.5)*2000; pos[i*3+1]=(Math.random()-.5)*2000; pos[i*3+2]=(Math.random()-.5)*2000;
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

// CURSOR
const cur=document.getElementById('cur'),ring=document.getElementById('cur-ring');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;cur.style.left=mx+'px';cur.style.top=my+'px';});
(function loop(){rx+=(mx-rx)*.1;ry+=(my-ry)*.1;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(loop);})();
document.querySelectorAll('a,button,input,select,label').forEach(el=>{
    el.addEventListener('mouseenter',()=>{ring.style.width='55px';ring.style.height='55px';ring.style.borderColor='rgba(255,60,46,.9)';});
    el.addEventListener('mouseleave',()=>{ring.style.width='38px';ring.style.height='38px';ring.style.borderColor='rgba(255,60,46,.5)';});
});
</script>
</body>
</html>
