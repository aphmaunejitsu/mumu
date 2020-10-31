<amp-animation id="show-page-top" layout="nodisplay">
<script type="application/json">
{
  "direction": "alternate",
  "duration": "300ms",
  "fill": "both",
  "animations": [{
    "selector": "#page-top",
    "easing": "cubic-bezier(.4,0,.2,1)",
    "keyframes": [{
      "opacity": "1",
      "visibility": "visible"
    }]
  }]
}
</script>
</amp-animation>

<amp-animation id="hide-page-top" layout="nodisplay">
<script type="application/json">
{
  "direction": "alternate",
  "duration": "300ms",
  "fill": "both",
  "animations": [{
    "selector": "#page-top",
    "easing": "cubic-bezier(.4,0,.2,1)",
    "keyframes": [{
      "opacity": "0",
      "visibility": "hidden"
    }]
  }]
}
</script>
</amp-animation>
