package com.webview.myapplication;

import android.content.Context;
import android.media.Ringtone;
import android.media.RingtoneManager;
import android.net.Uri;
import android.os.Build;
import android.webkit.JavascriptInterface;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.NotificationCompat;
import androidx.core.app.NotificationManagerCompat;

public class WebAppInterface {
    Context mContext;

    /** Instantiate the interface and set the context */
    WebAppInterface(Context c) {
        mContext = c;
    }

    WebAppInterface() {

    }

    /** Show a toast from the web page */
    @JavascriptInterface
    public void showToast(String toast) {
        Toast.makeText(mContext, toast, Toast.LENGTH_SHORT).show();
    }



    @JavascriptInterface
    public void notifyme() {
        NotificationCompat.Builder builder = new NotificationCompat.Builder(mContext.getApplicationContext(), "My Notification");
        builder.setContentTitle("SafeChat");
        builder.setContentText("New Message Arrived");
        builder.setSmallIcon(R.drawable.ic_launcher_background);
        builder.setAutoCancel(true);

        Uri notification = RingtoneManager.getDefaultUri(RingtoneManager.TYPE_NOTIFICATION);
        WebAppInterface instance = new WebAppInterface();
        String pckgname = instance.getClass().getPackage().getName();
        Uri alarmSound = Uri.parse("android.resource://"
                + pckgname + "/" + R.raw.beep);
        Ringtone r = RingtoneManager.getRingtone(mContext.getApplicationContext(), alarmSound);
        builder.setOnlyAlertOnce(true);
        r.play();


        NotificationManagerCompat managerCompat = NotificationManagerCompat.from(mContext.getApplicationContext());
        managerCompat.notify(1,builder.build());
    }
}