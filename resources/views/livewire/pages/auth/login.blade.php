<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login(): void
    {
        $this->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = \App\Models\User::where('email', $this->email)->first();

logger()->info('LOGIN DIAGNOSTIC', [
    'email' => $this->email,
    'user_found' => $user !== null,
    'password_matches' => $user
        ? \Illuminate\Support\Facades\Hash::check($this->password, $user->password)
        : false,
]);

if (!Auth::attempt(
    ['email' => $this->email, 'password' => $this->password],
    $this->remember
)) {
    throw ValidationException::withMessages([
        'email' => 'No account found with these credentials. Please check your email or password.',
    ]);
}
        session()->regenerate();
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<style>
* { margin:0; padding:0; box-sizing:border-box; }
html { font-size:16px; }
body {
    background:#000005 !important;
    color:#f0f0ff !important;
    font-family:'Barlow',sans-serif !important;
    cursor:none !important;
    overflow:hidden !important;
}
#lc { position:fixed; top:0; left:0; width:100%; height:100%; z-index:0; pointer-events:none; }
#lcur { width:10px; height:10px; background:#ff3c2e; border-radius:50%; position:fixed; pointer-events:none; z-index:9999; transform:translate(-50%,-50%); box-shadow:0 0 12px #ff3c2e; transition:transform .15s; }
#lring { width:38px; height:38px; border:1.5px solid rgba(255,60,46,.6); border-radius:50%; position:fixed; pointer-events:none; z-index:9998; transform:translate(-50%,-50%); transition:width .25s,height .25s,border-color .25s; }

.lp {
    position:fixed;
    inset:0;
    display:grid;
    grid-template-columns:1fr 1fr;
    z-index:1;
}

/* ─── LEFT ─── */
.ll {
    position:relative;
    overflow:hidden;
    display:flex;
    flex-direction:column;
    justify-content:center;
    padding:4rem;
}
.ll-bg {
    position:absolute; inset:0;
    background:url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=900&q=80') center/cover no-repeat;
    filter:brightness(.2) saturate(.5);
}
.ll-ov {
    position:absolute; inset:0;
    background:linear-gradient(135deg,rgba(0,0,5,.96) 0%,rgba(255,60,46,.04) 100%);
}
.ll-body { position:relative; z-index:2; }
.ll-logo {
    font-family:'Bebas Neue',cursive;
    font-size:2rem; letter-spacing:5px;
    color:#f0f0ff; text-decoration:none;
    display:block; margin-bottom:2.5rem;
}
.ll-logo span { color:#ff3c2e; text-shadow:0 0 20px rgba(255,60,46,.6); }
.ll-h1 {
    font-family:'Bebas Neue',cursive;
    font-size:5.5rem; line-height:.88;
    text-transform:uppercase; letter-spacing:2px;
    margin-bottom:1.5rem;
}
.ll-h1 .g { -webkit-text-stroke:1.5px rgba(240,240,255,.18); color:transparent; display:block; }
.ll-h1 .a { color:#ff3c2e; text-shadow:0 0 30px rgba(255,60,46,.5); display:block; }
.ll-p { color:rgba(240,240,255,.4); font-size:.95rem; line-height:1.8; font-weight:300; max-width:340px; margin-bottom:2.5rem; }
.ll-stats { display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem; }
.ll-sn { font-family:'Bebas Neue',cursive; font-size:2.5rem; color:#ff3c2e; line-height:1; text-shadow:0 0 20px rgba(255,60,46,.4); }
.ll-sl { font-size:.62rem; letter-spacing:2px; text-transform:uppercase; color:#446; margin-top:.2rem; }

/* ─── RIGHT ─── */
.lr {
    background:rgba(0,0,10,.82);
    backdrop-filter:blur(40px);
    border-left:1px solid rgba(255,255,255,.06);
    display:flex;
    flex-direction:column;
    justify-content:center;
    padding:2.5rem 3.5rem;
    overflow-y:auto;
}
.lr-title { font-family:'Bebas Neue',cursive; font-size:2.8rem; letter-spacing:2px; text-transform:uppercase; line-height:1; margin-bottom:.3rem; }
.lr-sub { font-size:.82rem; color:rgba(240,240,255,.38); margin-bottom:1.8rem; }
.lr-sub a { color:#ff3c2e; text-decoration:none; transition:text-shadow .3s; }
.lr-sub a:hover { text-shadow:0 0 10px rgba(255,60,46,.6); }

.lf { margin-bottom:1rem; }
.lf label { font-size:.65rem; letter-spacing:2.5px; text-transform:uppercase; color:#446; display:block; margin-bottom:.5rem; }
.lf input {
    width:100%;
    background:rgba(0,0,8,.95);
    border:1px solid rgba(255,255,255,.09);
    color:#f0f0ff;
    padding:.9rem 1.1rem;
    font-family:'Barlow',sans-serif;
    font-size:.9rem;
    outline:none;
    transition:border-color .3s,box-shadow .3s;
    border-radius:0;
}
.lf input::placeholder { color:rgba(240,240,255,.18); }
.lf input:focus { border-color:#ff3c2e; box-shadow:0 0 20px rgba(255,60,46,.12); }
.l-err { font-size:.7rem; color:#ff6b5b; margin-top:.25rem; }

.l-row { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.2rem; }
.l-rem { display:flex; align-items:center; gap:.5rem; font-size:.78rem; color:rgba(240,240,255,.38); cursor:pointer; }
.l-rem input[type=checkbox] { accent-color:#ff3c2e; }
.l-forg { font-size:.78rem; color:#ff3c2e; text-decoration:none; transition:text-shadow .3s; }
.l-forg:hover { text-shadow:0 0 10px rgba(255,60,46,.6); }

.l-btn {
    width:100%; background:#ff3c2e; color:#f0f0ff; border:none;
    padding:1rem; font-family:'Barlow',sans-serif;
    font-size:.9rem; font-weight:700; letter-spacing:3px;
    text-transform:uppercase; cursor:pointer; transition:all .3s;
    box-shadow:0 0 30px rgba(255,60,46,.35);
    clip-path:polygon(0 0,calc(100% - 10px) 0,100% 10px,100% 100%,10px 100%,0 calc(100% - 10px));
}
.l-btn:hover { box-shadow:0 0 50px rgba(255,60,46,.65); transform:translateY(-2px); }

.l-div { display:flex; align-items:center; gap:1rem; margin:1.2rem 0; }
.l-div::before,.l-div::after { content:''; flex:1; height:1px; background:rgba(255,255,255,.07); }
.l-div span { font-size:.68rem; letter-spacing:2px; text-transform:uppercase; color:#446; }
.l-reg { text-align:center; font-size:.82rem; color:rgba(240,240,255,.32); }
.l-reg a { color:#ff3c2e; text-decoration:none; font-weight:600; }
.l-status { background:rgba(70,180,70,.08); border:1px solid rgba(70,180,70,.25); padding:.75rem 1rem; margin-bottom:1.2rem; font-size:.8rem; color:#70b86e; }

@media(max-width:900px){
    .lp { grid-template-columns:1fr; position:relative; min-height:100vh; }
    .ll { display:none; }
    .lr { padding:2rem 1.5rem; }
}
</style>

<div class="lp">
<canvas id="lc"></canvas>
<div id="lcur"></div>
<div id="lring"></div>

    <!-- LEFT PANEL -->
    <div class="ll">
        <div class="ll-bg"></div>
        <div class="ll-ov"></div>
        <div class="ll-body">
            <a href="/" class="ll-logo">Gym<span>Pro</span></a>
            <div class="ll-h1">
                WELCOME
                <span class="g">BACK</span>
                <span class="a">CHAMPION</span>
            </div>
            <p class="ll-p">Your transformation journey continues. Log in to access your personalized workouts, diet charts, and progress dashboard.</p>
            <div class="ll-stats">
                <div><div class="ll-sn">500+</div><div class="ll-sl">Exercises</div></div>
                <div><div class="ll-sn">10K+</div><div class="ll-sl">Members</div></div>
                <div><div class="ll-sn">98%</div><div class="ll-sl">Success</div></div>
            </div>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="lr">
        <div class="lr-title">Sign In</div>
        <div class="lr-sub">New here? <a href="/register" wire:navigate>Create a free account →</a></div>

        @if(session('status'))
        <div class="l-status">✓ {{ session('status') }}</div>
        @endif

        <form wire:submit="login">
            <div class="lf">
                <label>Email Address</label>
                <input type="email" wire:model="email" placeholder="you@example.com" required autofocus>
                @error('email')<div class="l-err">⚠ {{ $message }}</div>@enderror
            </div>

            <div class="lf">
                <label>Password</label>
                <input type="password" wire:model="password" placeholder="Your password" required>
                @error('password')<div class="l-err">⚠ {{ $message }}</div>@enderror
            </div>

            <div class="l-row">
                <label class="l-rem">
                    <input type="checkbox" wire:model="remember"> Remember me
                </label>
                @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="l-forg" wire:navigate>Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="l-btn">Sign In →</button>
        </form>

        <div class="l-div"><span>or</span></div>
        <div class="l-reg">Don't have an account? <a href="/register" wire:navigate>Join GymPro Free</a></div>
    </div>

</div>

<script>
(function(){
    const c=document.getElementById('lc');
    const r=new THREE.WebGLRenderer({canvas:c,antialias:true,alpha:true});
    r.setSize(window.innerWidth,window.innerHeight);
    r.setPixelRatio(Math.min(devicePixelRatio,2));
    r.setClearColor(0x000005,1);
    const sc=new THREE.Scene(), cam=new THREE.PerspectiveCamera(75,innerWidth/innerHeight,.1,2000);
    cam.position.z=400;
    const g=new THREE.BufferGeometry(), n=6000, p=new Float32Array(n*3), cl=new Float32Array(n*3);
    for(let i=0;i<n;i++){
        p[i*3]=(Math.random()-.5)*2000; p[i*3+1]=(Math.random()-.5)*2000; p[i*3+2]=(Math.random()-.5)*2000;
        const rv=Math.random();
        if(rv<.05){cl[i*3]=1;cl[i*3+1]=.2;cl[i*3+2]=.1;}
        else if(rv<.15){cl[i*3]=.6;cl[i*3+1]=.7;cl[i*3+2]=1;}
        else{const v=.6+Math.random()*.4;cl[i*3]=v;cl[i*3+1]=v;cl[i*3+2]=v;}
    }
    g.setAttribute('position',new THREE.BufferAttribute(p,3));
    g.setAttribute('color',new THREE.BufferAttribute(cl,3));
    sc.add(new THREE.Points(g,new THREE.PointsMaterial({size:1.3,vertexColors:true,transparent:true,opacity:.85})));

    // Nebula glow
    function nebula(x,y,z,color,count,spread){
        const ng=new THREE.BufferGeometry(), np=new Float32Array(count*3);
        for(let i=0;i<count;i++){np[i*3]=x+(Math.random()-.5)*spread;np[i*3+1]=y+(Math.random()-.5)*spread;np[i*3+2]=z+(Math.random()-.5)*spread*.3;}
        ng.setAttribute('position',new THREE.BufferAttribute(np,3));
        sc.add(new THREE.Points(ng,new THREE.PointsMaterial({size:4,color,transparent:true,opacity:.1,blending:THREE.AdditiveBlending,depthWrite:false})));
    }
    nebula(-200,100,-200,0xff3c2e,600,350);
    nebula(200,-100,-250,0x2244ff,400,280);

    let t=0,mx=0,my=0;
    document.addEventListener('mousemove',e=>{mx=(e.clientX/innerWidth-.5)*2;my=(e.clientY/innerHeight-.5)*2;});
    (function loop(){requestAnimationFrame(loop);t+=.003;sc.rotation.y=t*.04+mx*.035;sc.rotation.x=my*.025;r.render(sc,cam);})();
    window.addEventListener('resize',()=>{cam.aspect=innerWidth/innerHeight;cam.updateProjectionMatrix();r.setSize(innerWidth,innerHeight);});
})();

const cur=document.getElementById('lcur'), ring=document.getElementById('lring');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove',e=>{ mx=e.clientX; my=e.clientY; cur.style.left=mx+'px'; cur.style.top=my+'px'; });
(function loop(){ rx+=(mx-rx)*.1; ry+=(my-ry)*.1; ring.style.left=rx+'px'; ring.style.top=ry+'px'; requestAnimationFrame(loop); })();
document.querySelectorAll('a,button,input,label').forEach(el=>{
    el.addEventListener('mouseenter',()=>{ ring.style.width='56px'; ring.style.height='56px'; ring.style.borderColor='rgba(255,60,46,1)'; });
    el.addEventListener('mouseleave',()=>{ ring.style.width='38px'; ring.style.height='38px'; ring.style.borderColor='rgba(255,60,46,.6)'; });
});
</script>
</div>