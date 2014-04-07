//This code loads the IFrame Player API code asynchronously.
var mpvsyt_tag = document.createElement('script');
mpvsyt_tag.src = "https://www.youtube.com/iframe_api";
var mpvsyt_script_tag = document.getElementsByTagName('script')[0];
mpvsyt_script_tag.parentNode.insertBefore(mpvsyt_tag, mpvsyt_script_tag);

//Fires when the API is ready
function onYouTubeIframeAPIReady() {
	
	mpvsyt_var = new YT.Player('mpvsyt', {
		videoId: mp_video_skinner_vars.video_id,
		width: '100%',
		height: '100%',
		playerVars: { 'controls': 0, 'modestbranding': 1, 'showinfo':0, 'wmode':'transparent', 'enablejsapi':1 , 'origin':'http://localhost:8888', 'rel':0, 'autoplay':mp_video_skinner_vars.autoplay },
		events: {
			'onReady': mpvsyt_on_ready,
			'onStateChange': mpvsyt_on_state_change
		}
	});
	
}

//Fires when the video player is ready.
function mpvsyt_on_ready(event) {
	
	//trigger set up event
	jQuery(window).trigger("mpvsyt_set_up_player", event);
	
	//Access the player like this:
	//event.target.mute();

}

//Fires when the players state changes
function mpvsyt_on_state_change(event) {
	
	//trigger state change event
	jQuery(window).trigger("mpvsyt_state_change", event);
	
}

//Fullscreen Function - looks for the right function for the right browser
function mpvsyt_launchFullscreen(element) {
  if(element.requestFullscreen) {
	element.requestFullscreen();
  } else if(element.mozRequestFullScreen) {
	element.mozRequestFullScreen();
  } else if(element.webkitRequestFullscreen) {
	element.webkitRequestFullscreen();
  } else if(element.msRequestFullscreen) {
	element.msRequestFullscreen();
  }
}