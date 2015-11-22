package com.example.pollapp;

import java.net.HttpURLConnection;
import java.util.concurrent.ExecutionException;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.net.ConnectivityManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.Window;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

/**
 * Software Engineering CSCI 540 Group #2 Project
 * 
 * This is the Android application used for our group project. Will load in the mobile-friendly
 * website into a WebView.
 * 
 * @project PollApp
 * @author Alexander Sniffin
 * @date Nov 21, 2015
 */
public class MainActivity extends Activity {
	
	/**
	 * Pointer for the webview
	 */
	private WebView webview;
	
	/**
	 * Url from where the app will load
	 */
	private static final String URL = "http://192.168.2.90/";
	
	/**
	 * Creates a seperate thread to check network connectivity to the server
	 */
	private LoadWebpage checkNetwork;

	/**
	 * Create a new Web View and load in the App
	 */
    public void onCreate(Bundle savedInstanceState) {
    	super.onCreate(savedInstanceState);
    	
    	getWindow().requestFeature(Window.FEATURE_PROGRESS);
    	
    	webview = new WebView(this);

    	WebSettings webSettings = webview.getSettings();
    	webSettings.setJavaScriptEnabled(true);

    	final Activity activity = this;
    	webview.setWebChromeClient(new WebChromeClient() {
    		public void onProgressChanged(WebView view, int progress) {
    			activity.setTitle("Loading...");
    			activity.setProgress(progress * 100); 

                if(progress == 100)
                	activity.setTitle("Official PollShark App");
    		}
    	});
    	
    	webview.setWebViewClient(new WebViewClient() {
    		public void onReceivedError(WebView view, int errorCode, String description, String failingUrl) {
    			Toast.makeText(activity, "Oh no! " + description, Toast.LENGTH_SHORT).show();
    		}
    		
    		public void onPageFinished(WebView view, String url) {
    			if (url.equals(URL))
    				message("Welcome", "Please login or register to start voting and creating your own polls on PollShark!");
    	    }
    	});

    	setContentView(webview);
    	
    	int errorCount = 0;
    	while (!isOnline(this) && errorCount++ < 3) {}
    	
	    if (errorCount < 3 ? true : false) {	
	    	checkNetwork.cancel(false);
	    	webview.loadUrl(URL);
    	} else {
    		Toast.makeText(this, "Error connecting with server...", Toast.LENGTH_LONG).show();
    		this.finish();
    	}
    }
    
    /**
     * If user presses back, go to the previous page
     */
    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        if (event.getAction() == KeyEvent.ACTION_DOWN) {
            switch (keyCode) {
                case KeyEvent.KEYCODE_BACK:
                    if (webview.canGoBack()) {
                        webview.goBack();
                    } else {
                        this.finish();
                    }
                    return true;
            }
        }
        return super.onKeyDown(keyCode, event);
    }
    
    /**
     * Check if the URL is online or not
     * 
     * @param context
     * @return True if online
     */
    public boolean isOnline(Context context) {
        ConnectivityManager connection = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        
		if (connection.getActiveNetworkInfo().isConnectedOrConnecting()) {
			try {
				checkNetwork = new LoadWebpage();
				
				if (checkNetwork.execute(URL).get().equals("success"))
					return true;
			} catch (InterruptedException | ExecutionException e) {
				e.printStackTrace();
			}
		}
        return false;
    }
    
    /**
     * Display a message using the AlertDialog class
     * 
     * @param Title text of the title
     * @param Message text of the message
     * @return An AlertDialog
     */
    public AlertDialog message(String title, String message) {
    	return new AlertDialog.Builder(this)
        .setTitle(title)
        .setMessage(message)
        .setPositiveButton(android.R.string.ok, null)
        .setIcon(android.R.drawable.btn_star)
        .show();
    }
    
    /**
     * Private class to create a new networking thread to verify if the website is online
     * 
     * @project PollApp
     * @author Alexander Sniffin
     * @date Nov 21, 2015
     */
    private class LoadWebpage extends AsyncTask<String, Void, String> {
		@Override
		protected String doInBackground(String... arg0) {
			try {
				java.net.URL url = new java.net.URL(URL);
	            HttpURLConnection urlc = (HttpURLConnection) url.openConnection();
	            urlc.setConnectTimeout(5000);
	            urlc.connect();
	
	            if (urlc.getResponseCode() == 200) {
	                return "success";
	            }
			} catch (Exception e) {
				e.printStackTrace();
			}
			return "failure";
		}
    }
}
