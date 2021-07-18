function sharelink(url){
    url="https://"+url;
  if (navigator.share) { 
   navigator.share({
      title: 'WebShare API Demo',
      url: url
    }).then(() => {
      console.log('Thanks for sharing!');
    })
    .catch(console.error);
    } else {
        alert("share api not supported");
    }
}