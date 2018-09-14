<template>
    <div id="footer-wrapper">
        <sui-grid :columns="3" divided stackable>
            <sui-grid-column >
               <h2>{{site.title}}</h2>
                <h3>{{site.subTitle}}</h3>
                <p> <sui-icon name="map marker alt" /> {{site.adress}},
                {{site.city}}</p>
                <p><sui-icon name="phone alt" />{{site.phone}} <br />
                    <sui-icon name="at" />{{site.email}}</p>
                <p>TVA: {{site.tva}}</p>
                <p>
                    <router-link :to="{ name: 'allergies'}" class="ui circular" >
                    Info Allergies
                </router-link>
                </p>
            </sui-grid-column>


            <sui-grid-column >
                <h2>Suivez La Clémentine sur Facebook et Instagram</h2>
                <instagram-footer :count="5" :cols="5"/>
                <sui-list horizontal>
                    <sui-list-item> </sui-list-item>
                    <sui-list-item><a :href="site.SocialInstagram"> <sui-button circular social="instagram" icon="instagram" /></a> </sui-list-item>
                    <sui-list-item><iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Ffacebook.com%2Flaclementine.be&width=178&layout=button_count&action=like&size=large&show_faces=false&share=true&height=46&appId=1146945778741142" width="178" height="65" style="border:none;overflow:hidden ; padding-top: 2.3rem;" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" ></iframe> </sui-list-item>
                </sui-list>
                <router-link :to="{name: 'privacy'}">Information concernant les données</router-link>
            </sui-grid-column>

            <sui-grid-column >
                <h2>Remerciements</h2>
                <a style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px" href="https://unsplash.com/@rawpixel?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from rawpixel"><span style="display:inline-block;padding:2px 3px"><svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-1px;fill:white" viewBox="0 0 32 32"><title>unsplash-logo</title><path d="M20.8 18.1c0 2.7-2.2 4.8-4.8 4.8s-4.8-2.1-4.8-4.8c0-2.7 2.2-4.8 4.8-4.8 2.7.1 4.8 2.2 4.8 4.8zm11.2-7.4v14.9c0 2.3-1.9 4.3-4.3 4.3h-23.4c-2.4 0-4.3-1.9-4.3-4.3v-15c0-2.3 1.9-4.3 4.3-4.3h3.7l.8-2.3c.4-1.1 1.7-2 2.9-2h8.6c1.2 0 2.5.9 2.9 2l.8 2.4h3.7c2.4 0 4.3 1.9 4.3 4.3zm-8.6 7.5c0-4.1-3.3-7.5-7.5-7.5-4.1 0-7.5 3.4-7.5 7.5s3.3 7.5 7.5 7.5c4.2-.1 7.5-3.4 7.5-7.5z"></path></svg></span><span style="display:inline-block;padding:2px 3px">rawpixel</span></a>
                <a style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px" href="https://unsplash.com/@lovelikesalt?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from Carly Jayne"><span style="display:inline-block;padding:2px 3px"><svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-1px;fill:white" viewBox="0 0 32 32"><title>unsplash-logo</title><path d="M20.8 18.1c0 2.7-2.2 4.8-4.8 4.8s-4.8-2.1-4.8-4.8c0-2.7 2.2-4.8 4.8-4.8 2.7.1 4.8 2.2 4.8 4.8zm11.2-7.4v14.9c0 2.3-1.9 4.3-4.3 4.3h-23.4c-2.4 0-4.3-1.9-4.3-4.3v-15c0-2.3 1.9-4.3 4.3-4.3h3.7l.8-2.3c.4-1.1 1.7-2 2.9-2h8.6c1.2 0 2.5.9 2.9 2l.8 2.4h3.7c2.4 0 4.3 1.9 4.3 4.3zm-8.6 7.5c0-4.1-3.3-7.5-7.5-7.5-4.1 0-7.5 3.4-7.5 7.5s3.3 7.5 7.5 7.5c4.2-.1 7.5-3.4 7.5-7.5z"></path></svg></span><span style="display:inline-block;padding:2px 3px">Carly Jayne</span></a>
                <a style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px" href="https://unsplash.com/@sharonmccutcheon?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from Sharon McCutcheon"><span style="display:inline-block;padding:2px 3px"><svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-1px;fill:white" viewBox="0 0 32 32"><title>unsplash-logo</title><path d="M20.8 18.1c0 2.7-2.2 4.8-4.8 4.8s-4.8-2.1-4.8-4.8c0-2.7 2.2-4.8 4.8-4.8 2.7.1 4.8 2.2 4.8 4.8zm11.2-7.4v14.9c0 2.3-1.9 4.3-4.3 4.3h-23.4c-2.4 0-4.3-1.9-4.3-4.3v-15c0-2.3 1.9-4.3 4.3-4.3h3.7l.8-2.3c.4-1.1 1.7-2 2.9-2h8.6c1.2 0 2.5.9 2.9 2l.8 2.4h3.7c2.4 0 4.3 1.9 4.3 4.3zm-8.6 7.5c0-4.1-3.3-7.5-7.5-7.5-4.1 0-7.5 3.4-7.5 7.5s3.3 7.5 7.5 7.5c4.2-.1 7.5-3.4 7.5-7.5z"></path></svg></span><span style="display:inline-block;padding:2px 3px">Sharon McCutcheon</span></a>

            </sui-grid-column>

        </sui-grid>
    </div>
</template>

<script>
    import instagramFooter from '../Photos/Instagram-footer' ;
    export default {
        name: 'pageFooter',
        components: {instagramFooter},
        props: ['site'],
        data (){
            return {    }
        },
        computed: {  }
    }

</script>

<style scoped>

 #footer-wrapper{
     margin: 5rem 0 0 0;
     padding: 1rem;
     background-color: floralwhite;
     color: orangered;
 }

 h2 {
     font-size: 1.2rem !important;
 }
 h3 {
     font-size: 1.1rem !important;
 }
 p {
     font-size: 1rem !important;
 }
    #facebook{
        padding-top: 10px !important;
        margin-top: 10px  !important;
    }
</style>
