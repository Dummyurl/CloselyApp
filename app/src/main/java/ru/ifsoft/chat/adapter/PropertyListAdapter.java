package ru.ifsoft.chat.adapter;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;

import java.util.List;

import ru.ifsoft.chat.R;
import ru.ifsoft.chat.model.Property;


public class PropertyListAdapter extends RecyclerView.Adapter<PropertyListAdapter.MyViewHolder> {

	private Context mContext;
	private List<Property> itemList;

	public class MyViewHolder extends RecyclerView.ViewHolder {

		public TextView title, status, marketValue;
		public ImageView thumbnail;

        public MyViewHolder(View view) {

			super(view);

			title = (TextView) view.findViewById(R.id.title);
			status = (TextView) view.findViewById(R.id.status);
			thumbnail = (ImageView) view.findViewById(R.id.thumbnail);
            marketValue = (TextView) view.findViewById(R.id.marketValue);
		}
	}


	public PropertyListAdapter(Context mContext, List<Property> itemList) {

		this.mContext = mContext;
		this.itemList = itemList;
	}

	@Override
	public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {

		View itemView = LayoutInflater.from(parent.getContext()).inflate(R.layout.user_list_row, parent, false);


		return new MyViewHolder(itemView);
	}

	@Override
	public void onBindViewHolder(final MyViewHolder holder, int position) {

        Property u = itemList.get(position);
		holder.title.setText(u.getLocationName());
		holder.marketValue.setText(Long.toString(u.getMarketValue()));

		if (!u.isForSell()) {

			holder.title.setCompoundDrawablesWithIntrinsicBounds(0, 0, 0, 0);

		} else {

			holder.title.setCompoundDrawablesWithIntrinsicBounds(0, 0, R.drawable.profile_verify_icon, 0);
		}

		// loading album cover using Glide library
		Glide.with(mContext).load(u.getLogo()).into(holder.thumbnail);
	}

	@Override
	public int getItemCount() {

		return itemList.size();
	}
}