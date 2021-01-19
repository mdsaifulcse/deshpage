var settings={url:window.location.href,total:0};function addURL(url){settings.url=url;}
function add(n){settings.total=settings.total+n;}
function convertNumber(n){if(n>=1000000000)return(n/1000000000).toFixed(1)+'G';if(n>=1000000)return(n/1000000).toFixed(1)+'M';if(n>=1000)return(n/1000).toFixed(1)+'K';return n;}
function updateCounter(){if(settings.total>0){$(".custom_share_count").html('<span class="custom_num">'+convertNumber(settings.total)+'</span><span class="share_word">SHARES</span>').fadeIn();}}
function getCount(){var url=settings.url;addthis.sharecounters.getShareCounts({service:'facebook',countUrl:url},function(response){add(response[0].count);updateCounter();});}