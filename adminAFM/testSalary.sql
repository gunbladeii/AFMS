SELECT 

month, year,nama,noIC,role,
stationCode,

SUM(itemCode - fail) AS totalParcel,

operationDay,

COUNT(date) AS totalAttend,

(SUM(itemCode - fail))/(COUNT(date)) AS avgDel,

(COUNT(date)) * 30 AS minDel,

(SUM(itemCode - fail)) - (COUNT(date)) AS delComm,

(SUM(itemCode - fail)) * 1.7 AS comission,

IF(COUNT(date)>24,50,0) AS attAllow,

IF(role='ss',2000,0) AS comFee,

IF(role='ss',
	(1*14.43)+(0*19.23),0) AS ot,

IF(role='ss',epfEmployer(SUM(itemCode - fail)*1.7+2000),0) AS epfEmployer,

IF(role='ss',socsoEmployer(((SUM(itemCode - fail)) * 1.7)+2000+

	(100*(COUNT(date)/operationDay))+

	(50*(COUNT(date)/operationDay))),0) AS socsoEmployer,

IF(role='ss',eisEmployer(((SUM(itemCode - fail)) * 1.7)+2000+

	(100*(COUNT(date)/operationDay))+

	(50*(COUNT(date)/operationDay))),0) AS eisEmployer,

IF(role='ss',epfEmployee(((SUM(itemCode - fail)) * 1.7)+2000),0) AS epfEmployee,

IF(role='ss',socsoEmployee(((SUM(itemCode - fail)) * 1.7)+2000+

	(100*(COUNT(date)/operationDay))+

	(50*(COUNT(date)/operationDay))),0) AS socsoEmployee,

IF(role='ss',eisEmployee(((SUM(itemCode - fail)) * 1.7)+2000+

	(100*(COUNT(date)/operationDay))+

	(50*(COUNT(date)/operationDay))),0) AS eisEmployee,

IF(role='ss',2000,0) AS hrdf,

SUM(fail) AS fail,

SUM(itemCode) AS receieved,


(1170*(COUNT(date)/26)) AS basicSalary,

(100*(COUNT(date)/26)) AS petrol, 

(50*(COUNT(date)/26)) AS handphone,

400 AS advanced

FROM infoParcel 

GROUP BY noIC,month,year  

ORDER BY stationCode  DESC

/*test sql timeDiff*/
SELECT * TIME_FORMAT(TIMEDIFF(timeOuttime)"%H") AS timeDiff IF(((TIME_FORMAT(TIMEDIFF(timeOuttime)"%H"))-8)>0(TIME_FORMAT(TIMEDIFF(timeOuttime)"%H"))-80) AS ot FROM `attendance`

/*test sql inner join attendance and infoParcel*/
SELECT attendance.noIC attendance.stationCode attendance.role attendance.nama attendance.date 
attendance.statusattendance.time attendance.timeOut attendance.month attendance.year infoParcel.itemCode
infoParcel.success infoParcel.fail infoParcel.operationDay FROM attendance INNER JOIN infoParcel ON attendance.noIC = infoParcel.noIC GROUP BY datenoIC

IF rate < 0	THEN SET epfEmployer = 0;			
ELSEIF (rate>= 0.01 AND rate <= 20.00) THEN SET epfEmployer = 3.00;
ELSEIF (rate>= 20.01 AND rate <= 40.00) THEN SET epfEmployer = 6.00;
ELSEIF (rate>= 40.01 AND rate <= 60.00) THEN SET epfEmployer = 8.00;
ELSEIF (rate>= 60.01 AND rate <= 80.00) THEN SET epfEmployer = 11.00;
ELSEIF (rate>= 80.01 AND rate <= 100.00) THEN SET epfEmployer = 13.00;
ELSEIF (rate>= 100.01 AND rate <= 120.00) THEN SET epfEmployer = 16.00;
ELSEIF (rate>= 120.01 AND rate <= 140.00) THEN SET epfEmployer = 19.00;
ELSEIF (rate>= 140.01 AND rate <= 160.00) THEN SET epfEmployer = 21.00;
ELSEIF (rate>= 160.01 AND rate <= 180.00) THEN SET epfEmployer = 24.00;
ELSEIF (rate>= 180.01 AND rate <= 200.00) THEN SET epfEmployer = 26.00;
ELSEIF (rate>= 200.01 AND rate <= 220.00) THEN SET epfEmployer = 29.00;
ELSEIF (rate>= 220.01 AND rate <= 240.00) THEN SET epfEmployer = 32.00;
ELSEIF (rate>= 240.01 AND rate <= 260.00) THEN SET epfEmployer = 34.00;
ELSEIF (rate>= 260.01 AND rate <= 280.00) THEN SET epfEmployer = 37.00;
ELSEIF (rate>= 280.01 AND rate <= 300.00) THEN SET epfEmployer = 39.00;
ELSEIF (rate>= 300.01 AND rate <= 320.00) THEN SET epfEmployer = 42.00;
ELSEIF (rate>= 320.01 AND rate <= 340.00) THEN SET epfEmployer = 45.00;
ELSEIF (rate>= 340.01 AND rate <= 360.00) THEN SET epfEmployer = 47.00;
ELSEIF (rate>= 360.01 AND rate <= 380.00) THEN SET epfEmployer = 50.00;
ELSEIF (rate>= 380.01 AND rate <= 400.00) THEN SET epfEmployer = 52.00;
ELSEIF (rate>= 400.01 AND rate <= 420.00) THEN SET epfEmployer = 55.00;
ELSEIF (rate>= 420.01 AND rate <= 440.00) THEN SET epfEmployer = 58.00;
ELSEIF (rate>= 440.01 AND rate <= 460.00) THEN SET epfEmployer = 60.00;
ELSEIF (rate>= 460.01 AND rate <= 480.00) THEN SET epfEmployer = 63.00;
ELSEIF (rate>= 480.01 AND rate <= 500.00) THEN SET epfEmployer = 65.00;
ELSEIF (rate>= 500.01 AND rate <= 520.00) THEN SET epfEmployer = 68.00;
ELSEIF (rate>= 520.01 AND rate <= 540.00) THEN SET epfEmployer = 71.00;
ELSEIF (rate>= 540.01 AND rate <= 560.00) THEN SET epfEmployer = 73.00;
ELSEIF (rate>= 560.01 AND rate <= 580.00) THEN SET epfEmployer = 76.00;
ELSEIF (rate>= 580.01 AND rate <= 600.00) THEN SET epfEmployer = 78.00;
ELSEIF (rate>= 600.01 AND rate <= 620.00) THEN SET epfEmployer = 81.00;
ELSEIF (rate>= 620.01 AND rate <= 640.00) THEN SET epfEmployer = 84.00;
ELSEIF (rate>= 640.01 AND rate <= 660.00) THEN SET epfEmployer = 86.00;
ELSEIF (rate>= 660.01 AND rate <= 680.00) THEN SET epfEmployer = 89.00;
ELSEIF (rate>= 680.01 AND rate <= 700.00) THEN SET epfEmployer = 91.00;
ELSEIF (rate>= 700.01 AND rate <= 720.00) THEN SET epfEmployer = 94.00;
ELSEIF (rate>= 720.01 AND rate <= 740.00) THEN SET epfEmployer = 97.00;
ELSEIF (rate>= 740.01 AND rate <= 760.00) THEN SET epfEmployer = 99.00;
ELSEIF (rate>= 760.01 AND rate <= 780.00) THEN SET epfEmployer = 102.00;
ELSEIF (rate>= 780.01 AND rate <= 800.00) THEN SET epfEmployer = 104.00;
ELSEIF (rate>= 800.01 AND rate <= 820.00) THEN SET epfEmployer = 107.00;
ELSEIF (rate>= 820.01 AND rate <= 840.00) THEN SET epfEmployer = 110.00;
ELSEIF (rate>= 840.01 AND rate <= 860.00) THEN SET epfEmployer = 112.00;
ELSEIF (rate>= 860.01 AND rate <= 880.00) THEN SET epfEmployer = 115.00;
ELSEIF (rate>= 880.01 AND rate <= 900.00) THEN SET epfEmployer = 117.00;
ELSEIF (rate>= 900.01 AND rate <= 920.00) THEN SET epfEmployer = 120.00;
ELSEIF (rate>= 920.01 AND rate <= 940.00) THEN SET epfEmployer = 123.00;
ELSEIF (rate>= 940.01 AND rate <= 960.00) THEN SET epfEmployer = 125.00;
ELSEIF (rate>= 960.01 AND rate <= 980.00) THEN SET epfEmployer = 128.00;
ELSEIF (rate>= 980.01 AND rate <= 1000.00) THEN SET epfEmployer = 130.00;
ELSEIF (rate>= 1000.01 AND rate <= 1020.00) THEN SET epfEmployer = 133.00;
ELSEIF (rate>= 1020.01 AND rate <= 1040.00) THEN SET epfEmployer = 136.00;
ELSEIF (rate>= 1040.01 AND rate <= 1060.00) THEN SET epfEmployer = 138.00;
ELSEIF (rate>= 1060.01 AND rate <= 1080.00) THEN SET epfEmployer = 141.00;
ELSEIF (rate>= 1080.01 AND rate <= 1100.00) THEN SET epfEmployer = 143.00;
ELSEIF (rate>= 1100.01 AND rate <= 1120.00) THEN SET epfEmployer = 146.00;
ELSEIF (rate>= 1120.01 AND rate <= 1140.00) THEN SET epfEmployer = 149.00;
ELSEIF (rate>= 1140.01 AND rate <= 1160.00) THEN SET epfEmployer = 151.00;
ELSEIF (rate>= 1160.01 AND rate <= 1180.00) THEN SET epfEmployer = 154.00;
ELSEIF (rate>= 1180.01 AND rate <= 1200.00) THEN SET epfEmployer = 156.00;
ELSEIF (rate>= 1200.01 AND rate <= 1220.00) THEN SET epfEmployer = 159.00;
ELSEIF (rate>= 1220.01 AND rate <= 1240.00) THEN SET epfEmployer = 162.00;
ELSEIF (rate>= 1240.01 AND rate <= 1260.00) THEN SET epfEmployer = 164.00;
ELSEIF (rate>= 1260.01 AND rate <= 1280.00) THEN SET epfEmployer = 167.00;
ELSEIF (rate>= 1280.01 AND rate <= 1300.00) THEN SET epfEmployer = 169.00;
ELSEIF (rate>= 1300.01 AND rate <= 1320.00) THEN SET epfEmployer = 172.00;
ELSEIF (rate>= 1320.01 AND rate <= 1340.00) THEN SET epfEmployer = 175.00;
ELSEIF (rate>= 1340.01 AND rate <= 1360.00) THEN SET epfEmployer = 177.00;
ELSEIF (rate>= 1360.01 AND rate <= 1380.00) THEN SET epfEmployer = 180.00;
ELSEIF (rate>= 1380.01 AND rate <= 1400.00) THEN SET epfEmployer = 182.00;
ELSEIF (rate>= 1400.01 AND rate <= 1420.00) THEN SET epfEmployer = 185.00;
ELSEIF (rate>= 1420.01 AND rate <= 1440.00) THEN SET epfEmployer = 188.00;
ELSEIF (rate>= 1440.01 AND rate <= 1460.00) THEN SET epfEmployer = 190.00;
ELSEIF (rate>= 1460.01 AND rate <= 1480.00) THEN SET epfEmployer = 193.00;
ELSEIF (rate>= 1480.01 AND rate <= 1500.00) THEN SET epfEmployer = 195.00;
ELSEIF (rate>= 1500.01 AND rate <= 1520.00) THEN SET epfEmployer = 198.00;
ELSEIF (rate>= 1520.01 AND rate <= 1540.00) THEN SET epfEmployer = 201.00;
ELSEIF (rate>= 1540.01 AND rate <= 1560.00) THEN SET epfEmployer = 203.00;
ELSEIF (rate>= 1560.01 AND rate <= 1580.00) THEN SET epfEmployer = 206.00;
ELSEIF (rate>= 1580.01 AND rate <= 1600.00) THEN SET epfEmployer = 208.00;
ELSEIF (rate>= 1600.01 AND rate <= 1620.00) THEN SET epfEmployer = 211.00;
ELSEIF (rate>= 1620.01 AND rate <= 1640.00) THEN SET epfEmployer = 214.00;
ELSEIF (rate>= 1640.01 AND rate <= 1660.00) THEN SET epfEmployer = 216.00;
ELSEIF (rate>= 1660.01 AND rate <= 1680.00) THEN SET epfEmployer = 219.00;
ELSEIF (rate>= 1680.01 AND rate <= 1700.00) THEN SET epfEmployer = 221.00;
ELSEIF (rate>= 1700.01 AND rate <= 1720.00) THEN SET epfEmployer = 224.00;
ELSEIF (rate>= 1720.01 AND rate <= 1740.00) THEN SET epfEmployer = 227.00;
ELSEIF (rate>= 1740.01 AND rate <= 1760.00) THEN SET epfEmployer = 229.00;
ELSEIF (rate>= 1760.01 AND rate <= 1780.00) THEN SET epfEmployer = 232.00;
ELSEIF (rate>= 1780.01 AND rate <= 1800.00) THEN SET epfEmployer = 234.00;
ELSEIF (rate>= 1800.01 AND rate <= 1820.00) THEN SET epfEmployer = 237.00;
ELSEIF (rate>= 1820.01 AND rate <= 1840.00) THEN SET epfEmployer = 240.00;
ELSEIF (rate>= 1840.01 AND rate <= 1860.00) THEN SET epfEmployer = 242.00;
ELSEIF (rate>= 1860.01 AND rate <= 1880.00) THEN SET epfEmployer = 245.00;
ELSEIF (rate>= 1880.01 AND rate <= 1900.00) THEN SET epfEmployer = 247.00;
ELSEIF (rate>= 1900.01 AND rate <= 1920.00) THEN SET epfEmployer = 250.00;
ELSEIF (rate>= 1920.01 AND rate <= 1940.00) THEN SET epfEmployer = 253.00;
ELSEIF (rate>= 1940.01 AND rate <= 1960.00) THEN SET epfEmployer = 255.00;
ELSEIF (rate>= 1960.01 AND rate <= 1980.00) THEN SET epfEmployer = 258.00;
ELSEIF (rate>= 1980.01 AND rate <= 2000.00) THEN SET epfEmployer = 260.00;
ELSEIF (rate>= 2000.01 AND rate <= 2020.00) THEN SET epfEmployer = 263.00;
ELSEIF (rate>= 2020.01 AND rate <= 2040.00) THEN SET epfEmployer = 266.00;
ELSEIF (rate>= 2040.01 AND rate <= 2060.00) THEN SET epfEmployer = 268.00;
ELSEIF (rate>= 2060.01 AND rate <= 2080.00) THEN SET epfEmployer = 271.00;
ELSEIF (rate>= 2080.01 AND rate <= 2100.00) THEN SET epfEmployer = 273.00;
ELSEIF (rate>= 2100.01 AND rate <= 2120.00) THEN SET epfEmployer = 276.00;
ELSEIF (rate>= 2120.01 AND rate <= 2140.00) THEN SET epfEmployer = 279.00;
ELSEIF (rate>= 2140.01 AND rate <= 2160.00) THEN SET epfEmployer = 281.00;
ELSEIF (rate>= 2160.01 AND rate <= 2180.00) THEN SET epfEmployer = 284.00;
ELSEIF (rate>= 2180.01 AND rate <= 2200.00) THEN SET epfEmployer = 286.00;
ELSEIF (rate>= 2200.01 AND rate <= 2220.00) THEN SET epfEmployer = 289.00;
ELSEIF (rate>= 2220.01 AND rate <= 2240.00) THEN SET epfEmployer = 292.00;
ELSEIF (rate>= 2240.01 AND rate <= 2260.00) THEN SET epfEmployer = 294.00;
ELSEIF (rate>= 2260.01 AND rate <= 2280.00) THEN SET epfEmployer = 297.00;
ELSEIF (rate>= 2280.01 AND rate <= 2300.00) THEN SET epfEmployer = 299.00;
ELSEIF (rate>= 2300.01 AND rate <= 2320.00) THEN SET epfEmployer = 302.00;
ELSEIF (rate>= 2320.01 AND rate <= 2340.00) THEN SET epfEmployer = 305.00;
ELSEIF (rate>= 2340.01 AND rate <= 2360.00) THEN SET epfEmployer = 307.00;
ELSEIF (rate>= 2360.01 AND rate <= 2380.00) THEN SET epfEmployer = 310.00;
ELSEIF (rate>= 2380.01 AND rate <= 2400.00) THEN SET epfEmployer = 312.00;
ELSEIF (rate>= 2400.01 AND rate <= 2420.00) THEN SET epfEmployer = 315.00;
ELSEIF (rate>= 2420.01 AND rate <= 2440.00) THEN SET epfEmployer = 318.00;
ELSEIF (rate>= 2440.01 AND rate <= 2460.00) THEN SET epfEmployer = 320.00;
ELSEIF (rate>= 2460.01 AND rate <= 2480.00) THEN SET epfEmployer = 323.00;
ELSEIF (rate>= 2480.01 AND rate <= 2500.00) THEN SET epfEmployer = 325.00;
ELSEIF (rate>= 2500.01 AND rate <= 2520.00) THEN SET epfEmployer = 328.00;
ELSEIF (rate>= 2520.01 AND rate <= 2540.00) THEN SET epfEmployer = 331.00;
ELSEIF (rate>= 2540.01 AND rate <= 2560.00) THEN SET epfEmployer = 333.00;
ELSEIF (rate>= 2560.01 AND rate <= 2580.00) THEN SET epfEmployer = 336.00;
ELSEIF (rate>= 2580.01 AND rate <= 2600.00) THEN SET epfEmployer = 338.00;
ELSEIF (rate>= 2600.01 AND rate <= 2620.00) THEN SET epfEmployer = 341.00;
ELSEIF (rate>= 2620.01 AND rate <= 2640.00) THEN SET epfEmployer = 344.00;
ELSEIF (rate>= 2640.01 AND rate <= 2660.00) THEN SET epfEmployer = 346.00;
ELSEIF (rate>= 2660.01 AND rate <= 2680.00) THEN SET epfEmployer = 349.00;
ELSEIF (rate>= 2680.01 AND rate <= 2700.00) THEN SET epfEmployer = 351.00;
ELSEIF (rate>= 2700.01 AND rate <= 2720.00) THEN SET epfEmployer = 354.00;
ELSEIF (rate>= 2720.01 AND rate <= 2740.00) THEN SET epfEmployer = 357.00;
ELSEIF (rate>= 2740.01 AND rate <= 2760.00) THEN SET epfEmployer = 359.00;
ELSEIF (rate>= 2760.01 AND rate <= 2780.00) THEN SET epfEmployer = 362.00;
ELSEIF (rate>= 2780.01 AND rate <= 2800.00) THEN SET epfEmployer = 364.00;
ELSEIF (rate>= 2800.01 AND rate <= 2820.00) THEN SET epfEmployer = 367.00;
ELSEIF (rate>= 2820.01 AND rate <= 2840.00) THEN SET epfEmployer = 370.00;
ELSEIF (rate>= 2840.01 AND rate <= 2860.00) THEN SET epfEmployer = 372.00;
ELSEIF (rate>= 2860.01 AND rate <= 2880.00) THEN SET epfEmployer = 375.00;
ELSEIF (rate>= 2880.01 AND rate <= 2900.00) THEN SET epfEmployer = 377.00;
ELSEIF (rate>= 2900.01 AND rate <= 2920.00) THEN SET epfEmployer = 380.00;
ELSEIF (rate>= 2920.01 AND rate <= 2940.00) THEN SET epfEmployer = 383.00;
ELSEIF (rate>= 2940.01 AND rate <= 2960.00) THEN SET epfEmployer = 385.00;
ELSEIF (rate>= 2960.01 AND rate <= 2980.00) THEN SET epfEmployer = 388.00;
ELSEIF (rate>= 2980.01 AND rate <= 3000.00) THEN SET epfEmployer = 390.00;
ELSEIF (rate>= 3000.01 AND rate <= 3020.00) THEN SET epfEmployer = 393.00;
ELSEIF (rate>= 3020.01 AND rate <= 3040.00) THEN SET epfEmployer = 396.00;
ELSEIF (rate>= 3040.01 AND rate <= 3060.00) THEN SET epfEmployer = 398.00;
ELSEIF (rate>= 3060.01 AND rate <= 3080.00) THEN SET epfEmployer = 401.00;
ELSEIF (rate>= 3080.01 AND rate <= 3100.00) THEN SET epfEmployer = 403.00;
ELSEIF (rate>= 3100.01 AND rate <= 3120.00) THEN SET epfEmployer = 406.00;
ELSEIF (rate>= 3120.01 AND rate <= 3140.00) THEN SET epfEmployer = 409.00;
ELSEIF (rate>= 3140.01 AND rate <= 3160.00) THEN SET epfEmployer = 411.00;
ELSEIF (rate>= 3160.01 AND rate <= 3180.00) THEN SET epfEmployer = 414.00;
ELSEIF (rate>= 3180.01 AND rate <= 3200.00) THEN SET epfEmployer = 416.00;
ELSEIF (rate>= 3200.01 AND rate <= 3220.00) THEN SET epfEmployer = 419.00;
ELSEIF (rate>= 3220.01 AND rate <= 3240.00) THEN SET epfEmployer = 422.00;
ELSEIF (rate>= 3240.01 AND rate <= 3260.00) THEN SET epfEmployer = 424.00;
ELSEIF (rate>= 3260.01 AND rate <= 3280.00) THEN SET epfEmployer = 427.00;
ELSEIF (rate>= 3280.01 AND rate <= 3300.00) THEN SET epfEmployer = 429.00;
ELSEIF (rate>= 3300.01 AND rate <= 3320.00) THEN SET epfEmployer = 432.00;
ELSEIF (rate>= 3320.01 AND rate <= 3340.00) THEN SET epfEmployer = 435.00;
ELSEIF (rate>= 3340.01 AND rate <= 3360.00) THEN SET epfEmployer = 437.00;
ELSEIF (rate>= 3360.01 AND rate <= 3380.00) THEN SET epfEmployer = 440.00;
ELSEIF (rate>= 3380.01 AND rate <= 3400.00) THEN SET epfEmployer = 442.00;
ELSEIF (rate>= 3400.01 AND rate <= 3420.00) THEN SET epfEmployer = 445.00;
ELSEIF (rate>= 3420.01 AND rate <= 3440.00) THEN SET epfEmployer = 448.00;
ELSEIF (rate>= 3440.01 AND rate <= 3460.00) THEN SET epfEmployer = 450.00;
ELSEIF (rate>= 3460.01 AND rate <= 3480.00) THEN SET epfEmployer = 453.00;
ELSEIF (rate>= 3480.01 AND rate <= 3500.00) THEN SET epfEmployer = 455.00;
ELSEIF (rate>= 3500.01 AND rate <= 3520.00) THEN SET epfEmployer = 458.00;
ELSEIF (rate>= 3520.01 AND rate <= 3540.00) THEN SET epfEmployer = 461.00;
ELSEIF (rate>= 3540.01 AND rate <= 3560.00) THEN SET epfEmployer = 463.00;
ELSEIF (rate>= 3560.01 AND rate <= 3580.00) THEN SET epfEmployer = 466.00;
ELSEIF (rate>= 3580.01 AND rate <= 3600.00) THEN SET epfEmployer = 468.00;
ELSEIF (rate>= 3600.01 AND rate <= 3620.00) THEN SET epfEmployer = 471.00;
ELSEIF (rate>= 3620.01 AND rate <= 3640.00) THEN SET epfEmployer = 474.00;
ELSEIF (rate>= 3640.01 AND rate <= 3660.00) THEN SET epfEmployer = 476.00;
ELSEIF (rate>= 3660.01 AND rate <= 3680.00) THEN SET epfEmployer = 479.00;
ELSEIF (rate>= 3680.01 AND rate <= 3700.00) THEN SET epfEmployer = 481.00;
ELSEIF (rate>= 3700.01 AND rate <= 3720.00) THEN SET epfEmployer = 484.00;
ELSEIF (rate>= 3720.01 AND rate <= 3740.00) THEN SET epfEmployer = 487.00;
ELSEIF (rate>= 3740.01 AND rate <= 3760.00) THEN SET epfEmployer = 489.00;
ELSEIF (rate>= 3760.01 AND rate <= 3780.00) THEN SET epfEmployer = 492.00;
ELSEIF (rate>= 3780.01 AND rate <= 3800.00) THEN SET epfEmployer = 494.00;
ELSEIF (rate>= 3800.01 AND rate <= 3820.00) THEN SET epfEmployer = 497.00;
ELSEIF (rate>= 3820.01 AND rate <= 3840.00) THEN SET epfEmployer = 500.00;
ELSEIF (rate>= 3840.01 AND rate <= 3860.00) THEN SET epfEmployer = 502.00;
ELSEIF (rate>= 3860.01 AND rate <= 3880.00) THEN SET epfEmployer = 505.00;
ELSEIF (rate>= 3880.01 AND rate <= 3900.00) THEN SET epfEmployer = 507.00;
ELSEIF (rate>= 3900.01 AND rate <= 3920.00) THEN SET epfEmployer = 510.00;
ELSEIF (rate>= 3920.01 AND rate <= 3940.00) THEN SET epfEmployer = 513.00;
ELSEIF (rate>= 3940.01 AND rate <= 3960.00) THEN SET epfEmployer = 515.00;
ELSEIF (rate>= 3960.01 AND rate <= 3980.00) THEN SET epfEmployer = 518.00;
ELSEIF (rate>= 3980.01 AND rate <= 4000.00) THEN SET epfEmployer = 520.00;
ELSEIF (rate>= 4000.01 AND rate <= 4020.00) THEN SET epfEmployer = 523.00;
ELSEIF (rate>= 4020.01 AND rate <= 4040.00) THEN SET epfEmployer = 526.00;
ELSEIF (rate>= 4040.01 AND rate <= 4060.00) THEN SET epfEmployer = 528.00;
ELSEIF (rate>= 4060.01 AND rate <= 4080.00) THEN SET epfEmployer = 531.00;
ELSEIF (rate>= 4080.01 AND rate <= 4100.00) THEN SET epfEmployer = 533.00;
ELSEIF (rate>= 4100.01 AND rate <= 4120.00) THEN SET epfEmployer = 536.00;
ELSEIF (rate>= 4120.01 AND rate <= 4140.00) THEN SET epfEmployer = 539.00;
ELSEIF (rate>= 4140.01 AND rate <= 4160.00) THEN SET epfEmployer = 541.00;
ELSEIF (rate>= 4160.01 AND rate <= 4180.00) THEN SET epfEmployer = 544.00;
ELSEIF (rate>= 4180.01 AND rate <= 4200.00) THEN SET epfEmployer = 546.00;
ELSEIF (rate>= 4200.01 AND rate <= 4220.00) THEN SET epfEmployer = 549.00;
ELSEIF (rate>= 4220.01 AND rate <= 4240.00) THEN SET epfEmployer = 552.00;
ELSEIF (rate>= 4240.01 AND rate <= 4260.00) THEN SET epfEmployer = 554.00;
ELSEIF (rate>= 4260.01 AND rate <= 4280.00) THEN SET epfEmployer = 557.00;
ELSEIF (rate>= 4280.01 AND rate <= 4300.00) THEN SET epfEmployer = 559.00;
ELSEIF (rate>= 4300.01 AND rate <= 4320.00) THEN SET epfEmployer = 562.00;
ELSEIF (rate>= 4320.01 AND rate <= 4340.00) THEN SET epfEmployer = 565.00;
ELSEIF (rate>= 4340.01 AND rate <= 4360.00) THEN SET epfEmployer = 567.00;
ELSEIF (rate>= 4360.01 AND rate <= 4380.00) THEN SET epfEmployer = 570.00;
ELSEIF (rate>= 4380.01 AND rate <= 4400.00) THEN SET epfEmployer = 572.00;
ELSEIF (rate>= 4400.01 AND rate <= 4420.00) THEN SET epfEmployer = 575.00;
ELSEIF (rate>= 4420.01 AND rate <= 4440.00) THEN SET epfEmployer = 578.00;
ELSEIF (rate>= 4440.01 AND rate <= 4460.00) THEN SET epfEmployer = 580.00;
ELSEIF (rate>= 4460.01 AND rate <= 4480.00) THEN SET epfEmployer = 583.00;
ELSEIF (rate>= 4480.01 AND rate <= 4500.00) THEN SET epfEmployer = 585.00;
ELSEIF (rate>= 4500.01 AND rate <= 4520.00) THEN SET epfEmployer = 588.00;
ELSEIF (rate>= 4520.01 AND rate <= 4540.00) THEN SET epfEmployer = 591.00;
ELSEIF (rate>= 4540.01 AND rate <= 4560.00) THEN SET epfEmployer = 593.00;
ELSEIF (rate>= 4560.01 AND rate <= 4580.00) THEN SET epfEmployer = 596.00;
ELSEIF (rate>= 4580.01 AND rate <= 4600.00) THEN SET epfEmployer = 598.00;
ELSEIF (rate>= 4600.01 AND rate <= 4620.00) THEN SET epfEmployer = 601.00;
ELSEIF (rate>= 4620.01 AND rate <= 4640.00) THEN SET epfEmployer = 604.00;
ELSEIF (rate>= 4640.01 AND rate <= 4660.00) THEN SET epfEmployer = 606.00;
ELSEIF (rate>= 4660.01 AND rate <= 4680.00) THEN SET epfEmployer = 609.00;
ELSEIF (rate>= 4680.01 AND rate <= 4700.00) THEN SET epfEmployer = 611.00;
ELSEIF (rate>= 4700.01 AND rate <= 4720.00) THEN SET epfEmployer = 614.00;
ELSEIF (rate>= 4720.01 AND rate <= 4740.00) THEN SET epfEmployer = 617.00;
ELSEIF (rate>= 4740.01 AND rate <= 4760.00) THEN SET epfEmployer = 619.00;
ELSEIF (rate>= 4760.01 AND rate <= 4780.00) THEN SET epfEmployer = 622.00;
ELSEIF (rate>= 4780.01 AND rate <= 4800.00) THEN SET epfEmployer = 624.00;
ELSEIF (rate>= 4800.01 AND rate <= 4820.00) THEN SET epfEmployer = 627.00;
ELSEIF (rate>= 4820.01 AND rate <= 4840.00) THEN SET epfEmployer = 630.00;
ELSEIF (rate>= 4840.01 AND rate <= 4860.00) THEN SET epfEmployer = 632.00;
ELSEIF (rate>= 4860.01 AND rate <= 4880.00) THEN SET epfEmployer = 635.00;
ELSEIF (rate>= 4880.01 AND rate <= 4900.00) THEN SET epfEmployer = 637.00;
ELSEIF (rate>= 4900.01 AND rate <= 4920.00) THEN SET epfEmployer = 640.00;
ELSEIF (rate>= 4920.01 AND rate <= 4940.00) THEN SET epfEmployer = 643.00;
ELSEIF (rate>= 4940.01 AND rate <= 4960.00) THEN SET epfEmployer = 645.00;
ELSEIF (rate>= 4960.01 AND rate <= 4980.00) THEN SET epfEmployer = 648.00;
ELSEIF (rate>= 4980.01 AND rate <= 5000.00) THEN SET epfEmployer = 650.00;
