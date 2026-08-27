import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Lenis from 'lenis';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 900,
        once: true,
        offset: 60,
        easing: 'ease-out-cubic',
    });

    const lenis = new Lenis({
        duration: 1.1,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        smoothWheel: true,
    });

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    gsap.utils.toArray('.gsap-fade-up').forEach((el) => {
        gsap.from(el, {
            y: 40,
            opacity: 0,
            duration: 0.9,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
            },
        });
    });

    gsap.utils.toArray('.gsap-parallax').forEach((el) => {
        gsap.to(el, {
            y: -60,
            ease: 'none',
            scrollTrigger: {
                trigger: el,
                start: 'top bottom',
                end: 'bottom top',
                scrub: true,
            },
        });
    });
});

document.addEventListener('livewire:navigated', () => {
    AOS.refresh();
    ScrollTrigger.refresh();
});
