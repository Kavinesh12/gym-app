<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $gender = '';
    public string $date_of_birth = '';
    public string $height = '';
    public string $weight = '';
    public string $fitness_goal = 'maintain';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone'         => ['nullable', 'string', 'max:20'],
            'gender'        => ['nullable', 'in:male,female,other'],
            'date_of_birth' => ['nullable', 'date'],
            'height'        => ['nullable', 'numeric', 'min:50', 'max:300'],
            'weight'        => ['nullable', 'numeric', 'min:10', 'max:500'],
            'fitness_goal'  => ['nullable', 'in:bulk,cut,maintain'],
            'password'      => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'user';

        event(new Registered($user = User::create($validated)));
        Auth::login($user);

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
    min-height:100vh !important;
    overflow-x:hidden !important;
}
#rc { position:fixed; top:0; left:0; width:100%; height:100%; z-index:0; pointer-events:none; }
#rcur { width:10px; height:10px; background:#ff3c2e; border-radius:50%; position:fixed; pointer-events:none; z-index:9999; transform:translate(-50%,-50%); box-shadow:0 0 12px #ff3c2e; }
#rring { width:38px; height:38px; border:1.5px solid rgba(255,60,46,.6); border-radius:50%; position:fixed; pointer-events:none; z-index:9998; transform:translate(-50%,-50%); transition:width .25s,height .25s; }

.rp {
    position:fixed;
    inset:0;
    display:grid;
    grid-template-columns:1fr 1fr;
    z-index:1;
    overflow:hidden;
}

.rp {
    position:fixed;
    inset:0;
    display:grid;
    grid-template-columns:1fr 1fr;
    z-index:1;
    overflow:hidden;
}

/* LEFT */
.rl { position:relative; overflow:hidden; display:flex; flex-direction:column; justify-content:center; padding:3.5rem; }
.rl-bg { position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=900&q=80') center/cover; filter:brightness(.2) saturate(.5); z-index:0; }
.rl-ov { position:absolute; inset:0; background:linear-gradient(135deg,rgba(0,0,5,.96) 0%,rgba(255,60,46,.04) 100%); z-index:1; }
.rl-body { position:relative; z-index:2; }
.rl-logo { font-family:'Bebas Neue',cursive; font-size:1.8rem; letter-spacing:5px; color:#f0f0ff; text-decoration:none; display:block; margin-bottom:2rem; }
.rl-logo span { color:#ff3c2e; text-shadow:0 0 20px rgba(255,60,46,.6); }
.rl-h1 { font-family:'Bebas Neue',cursive; font-size:clamp(3rem,5vw,5rem); line-height:.88; text-transform:uppercase; letter-spacing:2px; margin-bottom:1.2rem; }
.rl-h1 .g { -webkit-text-stroke:1.5px rgba(240,240,255,.18); color:transparent; display:block; }
.rl-h1 .a { color:#ff3c2e; text-shadow:0 0 30px rgba(255,60,46,.5); display:block; }
.rl-p { color:rgba(240,240,255,.4); font-size:.88rem; line-height:1.8; font-weight:300; max-width:320px; margin-bottom:1.5rem; }
.rl-feats { display:flex; flex-direction:column; gap:.55rem; }
.rl-feat { display:flex; align-items:center; gap:.75rem; font-size:.78rem; color:rgba(240,240,255,.48); }
.rl-dot { width:6px; height:6px; border-radius:50%; background:#ff3c2e; box-shadow:0 0 8px #ff3c2e; flex-shrink:0; }

/* RIGHT */
.rr {
    background:rgba(0,0,10,.84);
    backdrop-filter:blur(40px);
    border-left:1px solid rgba(255,255,255,.06);
    padding:2rem 3rem;
    overflow-y:auto;
    display:flex;
    flex-direction:column;
    justify-content:flex-start;
}
.rr-title { font-family:'Bebas Neue',cursive; font-size:2.4rem; letter-spacing:2px; text-transform:uppercase; line-height:1; margin-bottom:.25rem; margin-top:1.5rem; }
.rr-sub { font-size:.8rem; color:rgba(240,240,255,.38); margin-bottom:1.2rem; }
.rr-sub a { color:#ff3c2e; text-decoration:none; }

.rg { display:grid; grid-template-columns:1fr 1fr; gap:.55rem; }
.rf { display:flex; flex-direction:column; gap:.28rem; }
.rf.full { grid-column:span 2; }
.rf label { font-size:.6rem; letter-spacing:2px; text-transform:uppercase; color:#446; }
.rf input, .rf select {
    width:100%; background:rgba(0,0,8,.95); border:1px solid rgba(255,255,255,.09);
    color:#f0f0ff; padding:.65rem .85rem; font-family:'Barlow',sans-serif; font-size:.86rem;
    outline:none; transition:border-color .3s,box-shadow .3s; appearance:none; border-radius:0;
}
.rf input::placeholder { color:rgba(240,240,255,.18); }
.rf input:focus, .rf select:focus { border-color:#ff3c2e; box-shadow:0 0 15px rgba(255,60,46,.12); }
.rf select option { background:#0a0a15; }
.two { display:grid; grid-template-columns:1fr 1fr; gap:.5rem; }
.r-err { font-size:.68rem; color:#ff6b5b; }

.goal-row { display:grid; grid-template-columns:repeat(3,1fr); gap:.5rem; }
.gi { display:none; }
.gb { border:1px solid rgba(255,255,255,.09); padding:.5rem .3rem; text-align:center; font-size:.66rem; letter-spacing:1.5px; text-transform:uppercase; color:#446; cursor:pointer; transition:all .3s; display:block; }
.gi:checked + .gb { border-color:#ff3c2e; color:#ff3c2e; background:rgba(255,60,46,.08); box-shadow:0 0 12px rgba(255,60,46,.15); }
.gb:hover { border-color:rgba(255,60,46,.4); color:rgba(240,240,255,.7); }

.r-div { display:flex; align-items:center; gap:1rem; grid-column:span 2; margin:.2rem 0; }
.r-div::before,.r-div::after { content:''; flex:1; height:1px; background:rgba(255,255,255,.07); }
.r-div span { font-size:.62rem; letter-spacing:2px; text-transform:uppercase; color:#446; }

.r-btn {
    width:100%; background:#ff3c2e; color:#f0f0ff; border:none;
    padding:.9rem; font-family:'Barlow',sans-serif; font-size:.88rem; font-weight:700;
    letter-spacing:3px; text-transform:uppercase; cursor:pointer; transition:all .3s;
    box-shadow:0 0 30px rgba(255,60,46,.35);
    clip-path:polygon(0 0,calc(100% - 8px) 0,100% 8px,100% 100%,8px 100%,0 calc(100% - 8px));
}
.r-btn:hover { box-shadow:0 0 50px rgba(255,60,46,.65); transform:translateY(-1px); }

@media(max-width:900px){
    .rp { position:relative; grid-template-columns:1fr; }
    .rl { display:none; }
    .rr { padding:2rem 1.5rem; min-height:100vh; justify-content:flex-start; }
    .rg { grid-template-columns:1fr; }
    .rf.full { grid-column:span 1; }
    .r-div { grid-column:span 1; }
}
</style>

<div class="rp">
<canvas id="rc"></canvas>
<div id="rcur"></div>
<div id="rring"></div>

    <!-- LEFT -->
    <div class="rl">
        <div class="rl-bg"></div>
        <div class="rl-ov"></div>
        <div class="rl-body">
            <a href="/" class="rl-logo">Gym<span>Pro</span></a>
            <div class="rl-h1">JOIN THE<br><span class="g">ELITE</span><span class="a">SQUAD</span></div>
            <p class="rl-p">Start your transformation today. Get personalized workouts, diet charts, and progress tracking built for your goals.</p>
            <div class="rl-feats">
                <div class="rl-feat"><span class="rl-dot"></span>500+ Muscle-based workout plans</div>
                <div class="rl-feat"><span class="rl-dot"></span>Personalized diet charts</div>
                <div class="rl-feat"><span class="rl-dot"></span>Real-time progress tracking</div>
                <div class="rl-feat"><span class="rl-dot"></span>BMI & body stats calculator</div>
                <div class="rl-feat"><span class="rl-dot"></span>Expert trainer guidance</div>
            </div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="rr">
        <div class="rr-title">Create Account</div>
        <div class="rr-sub">Already have an account? <a href="/login" wire:navigate>Sign in →</a></div>

        <form wire:submit="register">
            <div class="rg">

                <div class="rf full">
                    <label>Full Name</label>
                    <input type="text" wire:model="name" placeholder="e.g. Kavinesh S" required autofocus>
                    @error('name')<div class="r-err">{{ $message }}</div>@enderror
                </div>

                <div class="rf full">
                    <label>Email Address</label>
                    <input type="email" wire:model="email" placeholder="you@example.com" required>
                    @error('email')<div class="r-err">{{ $message }}</div>@enderror
                </div>

                <div class="rf">
                    <label>Phone Number</label>
                    <input type="tel" wire:model="phone" placeholder="+91 99999 99999">
                    @error('phone')<div class="r-err">{{ $message }}</div>@enderror
                </div>

                <div class="rf">
                    <label>Gender</label>
                    <select wire:model="gender">
                        <option value="">Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    @error('gender')<div class="r-err">{{ $message }}</div>@enderror
                </div>

                <div class="rf">
                    <label>Date of Birth</label>
                    <input type="date" wire:model="date_of_birth">
                    @error('date_of_birth')<div class="r-err">{{ $message }}</div>@enderror
                </div>

                <div class="rf">
                    <label>Height (cm) & Weight (kg)</label>
                    <div class="two">
                        <input type="number" wire:model="height" placeholder="Height cm">
                        <input type="number" wire:model="weight" placeholder="Weight kg">
                    </div>
                </div>

                <div class="rf full">
                    <label>Fitness Goal</label>
                    <div class="goal-row">
                        <div>
                            <input type="radio" class="gi" wire:model="fitness_goal" id="gb1" value="bulk">
                            <label class="gb" for="gb1">💪 Bulk Up</label>
                        </div>
                        <div>
                            <input type="radio" class="gi" wire:model="fitness_goal" id="gb2" value="cut">
                            <label class="gb" for="gb2">🔥 Cut Fat</label>
                        </div>
                        <div>
                            <input type="radio" class="gi" wire:model="fitness_goal" id="gb3" value="maintain">
                            <label class="gb" for="gb3">⚡ Maintain</label>
                        </div>
                    </div>
                </div>

                <div class="r-div"><span>Security</span></div>

                <div class="rf">
                    <label>Password</label>
                    <input type="password" wire:model="password" placeholder="Min 8 characters" required>
                    @error('password')<div class="r-err">{{ $message }}</div>@enderror
                </div>

                <div class="rf">
                    <label>Confirm Password</label>
                    <input type="password" wire:model="password_confirmation" placeholder="Repeat password" required>
                </div>

                <div class="rf full">
                    <button type="submit" class="r-btn">Create My Account →</button>
                </div>

            </div>
        </form>
    </div>

</div>

<script>
(function(){
    const c=document.getElementById('rc');
    const r=new THREE.WebGLRenderer({canvas:c,antialias:true,alpha:true});
    r.setSize(innerWidth,innerHeight); r.setPixelRatio(Math.min(devicePixelRatio,2)); r.setClearColor(0x000005,1);
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
    let t=0,mx=0,my=0;
    document.addEventListener('mousemove',e=>{mx=(e.clientX/innerWidth-.5)*2;my=(e.clientY/innerHeight-.5)*2;});
    (function loop(){requestAnimationFrame(loop);t+=.003;sc.rotation.y=t*.04+mx*.035;sc.rotation.x=my*.025;r.render(sc,cam);})();
    window.addEventListener('resize',()=>{cam.aspect=innerWidth/innerHeight;cam.updateProjectionMatrix();r.setSize(innerWidth,innerHeight);});
})();
const cur=document.getElementById('rcur'),ring=document.getElementById('rring');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;cur.style.left=mx+'px';cur.style.top=my+'px';});
(function loop(){rx+=(mx-rx)*.1;ry+=(my-ry)*.1;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(loop);})();
document.querySelectorAll('a,button,input,select,label').forEach(el=>{
    el.addEventListener('mouseenter',()=>{ring.style.width='56px';ring.style.height='56px';ring.style.borderColor='rgba(255,60,46,1)';});
    el.addEventListener('mouseleave',()=>{ring.style.width='38px';ring.style.height='38px';ring.style.borderColor='rgba(255,60,46,.6)';});
});
</script>
</div>