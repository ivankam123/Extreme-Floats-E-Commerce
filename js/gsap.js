gsap.from(".extreme-rapids", {
  scrollTrigger: {
    trigger: ".extreme-rapids",
    start: "top 10%",
    end: "bottom 80%",
    scrub: 1,
    pin: true,
    markers: true,
  },
  opacity: 0,
  y: "10vh",
});

gsap.fromTo(
  ".extreme-rapids",
  {
    opacity: 1,
    y: 0,
  },
  {
    scrollTrigger: {
      trigger: ".extreme-rapids",
      start: "bottom 50%",
      end: "+=30%",
      scrub: 1,
    },
    opacity: 0,
    y: "-10vh",
  }
);

// gsap.from(".scenic-float", {
//   scrollTrigger: {
//     trigger: ".scenic-float",
//     start: "center bottom",
//     toggleActions: "restart none none none",
//   },
//   opacity: 0,
//   y: 100,
//   duration: 1,
//   once: false,
//   delay: 0.3,
// });

// gsap.from(".breezy-voyage", {
//   scrollTrigger: {
//     trigger: ".breezy-voyage",
//     start: "center bottom",
//     toggleActions: "restart none none none",
//   },
//   opacity: 0,
//   y: 100,
//   duration: 1,
//   once: false,
//   delay: 0.3,
// });

// gsap.from(".family-venture", {
//   scrollTrigger: {
//     trigger: ".family-venture",
//     start: "center bottom",
//     toggleActions: "restart none none none",
//   },
//   opacity: 0,
//   y: 100,
//   duration: 1,
//   once: false,
//   delay: 0.3,
// });
