package ru.ifsoft.chat.model;

import android.app.Application;
import android.os.Parcel;
import android.os.Parcelable;
import android.util.Log;

import org.json.JSONObject;

import ru.ifsoft.chat.constants.Constants;


public class Property extends Application implements Constants, Parcelable {

    private long market_value, owned_customer_id, id;

    private double lat, lng;

    private String locationName, address, logo, discount;

    private Boolean forsell;

    public Property() {


    }

    public Property(JSONObject jsonData) {

        try {

            if (!jsonData.getBoolean("error")) {

                this.setId(jsonData.getLong("id"));
                this.setMarketValue(jsonData.getLong("market_value"));
                this.setOwnedCusromerId(jsonData.getInt("owned_customer_id"));
                this.setDiscount(jsonData.getString("discount"));
                this.setLocation(jsonData.getDouble("lat"), jsonData.getDouble("lng"));
                this.setLocationName(jsonData.getString("name"));
                this.setAddress(jsonData.getString("address"));
                this.setLogo(jsonData.getString("logo"));
                this.setForsell(jsonData.getBoolean("forsell"));
            }

        } catch (Throwable t) {

            Log.e("Guest", "Could not parse malformed JSON: \"" + jsonData.toString() + "\"");

        } finally {

            Log.d("Guest", jsonData.toString());
        }
    }

    public void setId(long id) {

        this.id = id;
    }

    public long getId() {

        return this.id;
    }

    public void setMarketValue(long marketValue) {

        this.market_value = marketValue;
    }

    public void setOwnedCusromerId(int cId) {

        this.owned_customer_id = cId;
    }

    public void setDiscount(String discount) {

        this.discount = discount;
    }

    public void setLocation(Double lat, Double lng) {

        this.lng = lng;
        this.lat = lat;
    }

    public void setLocationName(String location) {

        this.locationName = location;
    }

    public void setAddress(String address) {

        this.address = address;
    }

    public void setLogo(String logo) {

        this.logo = logo;
    }

    public void setForsell(boolean forsell) {

        this.forsell = forsell;
    }


    public long getMarketValue() {

        return this.market_value;
    }

    public long getOwnedCusromerId() {

        return this.owned_customer_id;
    }

    public boolean isForSell() {

        return this.forsell;
    }

    public Double getLat() {

        return this.lat;
    }

    public Double getLng() {

        return this.lng;
    }


    public String getLocationName() {

        return this.locationName;
    }

    public String getAddress() {

        return this.address;
    }

    public String getLogo() {

        return this.logo;
    }

    public boolean getForsell() {

        return this.forsell;
    }

    @Override
    public int describeContents() {

        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {

    }
    public static final Creator CREATOR = new Creator() {

        public Property createFromParcel(Parcel in) {

            return new Property();
        }

        public Property[] newArray(int size) {
            return new Property[size];
        }
    };
}
