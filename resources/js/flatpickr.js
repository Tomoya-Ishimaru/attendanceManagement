import flatpickr from "flatpickr";
import monthSelectPlugin from 'flatpickr/dist/plugins/monthSelect/index';
import { Japanese } from "flatpickr/dist/l10n/ja.js"


flatpickr("#calendar", {
  "locale": Japanese,
  // minDate: "today",
  maxDate: new Date().fp_incr(0) 
});

flatpickr("#monthCalendar", {
  "locale": Japanese,
  plugins:[
    new monthSelectPlugin({
      dateFormat: "Y-m"
    })
  ]
});

const setting = {
  "locale": Japanese,
  enableTime: true,
  noCalendar: true,
  dateFormat: "H:i:s",
  time_24hr: true,
  // minTime: "10:00",
  // maxTime: "20:00",
  // minuteIncrement: 30
}

flatpickr("#start_time", setting);
flatpickr("#end_time", setting);