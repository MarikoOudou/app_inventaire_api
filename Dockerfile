# # Utilise l'image openjdk pour Java 17
# FROM openjdk:17-jdk-slim

# # Définir un répertoire de travail pour l'application
# WORKDIR /app

# # Copier le fichier JAR de l'application dans le conteneur
# COPY target/*.jar app.jar

# # Expose le port par défaut de Spring Boot
# EXPOSE 9000

# # Commande pour lancer l'application Spring Boot
# ENTRYPOINT ["java", "-jar", "app.jar"]


FROM eclipse-temurin:17-jdk-focal
 
WORKDIR /app
 
COPY .mvn/ .mvn
COPY mvnw pom.xml ./
RUN chmod +x mvnw
RUN ./mvnw dependency:go-offline
 
COPY src ./src

EXPOSE 9000
 
CMD ["./mvnw", "spring-boot:run"]