from os.path import exists
import random

points_count = 10000

#Get a random point with its latitude and longitude in Bulgaria and the southern parts of Romania
def getRandomPointLanLonInBG():
    return (round(random.uniform( 41.8,  44), 5),
            round(random.uniform(23, 27.4), 5))

#Generates points array, containing generated points as strings
def generatePointsArr():
    points_arr = []
    for x in range(points_count):
        new_point = getRandomPointLanLonInBG()
        point_str = "('%s', '%s', '%s')" % (new_point[0], new_point[1], "Point" + str(x+1))
        points_arr.append(point_str)
    return points_arr

#Get sql insert query, containing all generated points as a single string
def getPointsInsertQuery():
    query_first = "INSERT INTO points (lat, `long`, name) VALUES \n"

    points_arr = generatePointsArr()
    query_second = ', \n'.join(points_arr)

    return query_first + query_second

#Save the query to an .sql file, located in the current dir
def saveInsertQueryToFile():
    query = getPointsInsertQuery()

    if(not exists("insert_points.sql")):
        file = open("insert_points.sql", "w")
        file.write(query)
        file.close()
    else:
        print("File with insert query already exists!")



saveInsertQueryToFile()